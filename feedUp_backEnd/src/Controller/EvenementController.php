<?php

namespace App\Controller;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class EvenementController extends AbstractController
{
  
    /**
     * @Route("/evenement/getAllEvents", name="getAllEvents", methods={"GET"})
    */
    public function getAllEvents(EvenementRepository $repo, SerializerInterface $serializer): Response
    {
        $list=$repo->findAll();
     
        $data = $serializer->serialize($list, 'json');
        $response = new Response($data, 200);
        //content type
        $response->headers->set('Content-Type', 'application/json');
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }

    /**
    * @Route("/evenement/addEvent", name="addEvent", methods={"post"})
    * @return Response
    */
    public function addEvent(Request $req, SerializerInterface $serializer): Response
    {
       
        $data=$req->getContent();
        $event = $serializer->deserialize($data, 'App\Entity\Evenement', 'json');
        $em= $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();
        dd($event);
        $response = new Response('', Response::HTTP_CREATED);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'POST');
        return $response;

    }

    /**
    * @Route("/evenement/{id}/delete", name="deleteEvent", methods={"delete"})
    * @return Response
    */
    public function deleteEvent($id): Response
   {
       $ev = $this->getDoctrine()->getManager();
       $event = $ev->getRepository(Evenement::class)->find($id);
       $ev->remove($event);
       $ev->flush();
       $response = new Response('', Response::HTTP_OK);
       //Allow all websites
       $response->headers->set('Access-Control-Allow-Origin', '*');
       // You can set the allowed methods too, if you want
       $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
       return $response;
   }

   

     

   /** 
    * @Route("/evenement/update/{id}", name="editEvent", methods={"PUT"})
    */
    public function editEvent(
    Evenement $evenement,
    Request $request,
    EntityManagerInterface $us,
    SerializerInterface $serializer
): Response
{
    $serializer->deserialize($request->getContent(),
    Evenement::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $evenement]
    );

    $us->flush();
    return new JsonResponse(
        $serializer->serialize($evenement, "json"),
        JsonResponse::HTTP_NO_CONTENT,
        [],
        true
    );
}


    /**
     * @Route("/getEvent/{id}", name="showEvent", methods={"get"})
     */
    public function getEvent($id,EvenementRepository $repository)  {
        $event=$repository->find($id);
        $encoders= array(new JsonEncoder());
        $serializer= new Serializer([new ObjectNormalizer()],$encoders);
        //dd($serializer);
        $data = $serializer->serialize($event, 'json', ['circular_reference_handler'=>function($object){
            return $object->getId();}]
        );
        $response= new Response($data, 200);
        //var_dump($data);
        //content type
        $response->headers->set('Content-Type', 'application/json');
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'GET');
        return $response;
    }

   

}
