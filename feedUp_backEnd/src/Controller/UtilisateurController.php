<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

    /**
     * @Route("/user", name="utilisateur")
     */
class UtilisateurController extends AbstractController
{


    /**
     * @Route("/getAllUsers", name="getAllUsers", methods={"GET"})
     */
    public function getAllUsers(utilisateurRepository $repository ): Response
    {
    $list = $repository->findAll();
   $encoders = array(new JsonEncoder());
   $serializer = new Serializer([new ObjectNormalizer()], $encoders);
   $data = $serializer->serialize($list, 'json');
   $response = new Response($data, 200);
   //content type
   $response->headers->set('Content-Type', 'application/json');
   //Allow all websites
   $response->headers->set('Access-Control-Allow-Origin', '*');
   // You can set the allowed methods too, if you want
   $response->headers->set('Access-Control-Allow-Methods',  'GET');
   return $response;


    }


   /**
    * @Route("/{id}/delete", name="deleteUser", methods={"delete"})
    * @return Response
    */
    public function deleteEvent($id): Response
   {
       $us = $this->getDoctrine()->getManager();
       $user = $us->getRepository(Utilisateur::class)->find($id);
       $us->remove($user);
       $us->flush();
       $response = new Response('', Response::HTTP_OK);

       $response->headers->set('Access-Control-Allow-Origin', '*');
       $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
       return $response;
   }

/**
 * @Route("/adduser", name="adduser", methods={"post"})
 */

public function addGroupe (Request $request):Response
{
   $data = $request->getContent();
   $encoders = array(new JsonEncoder());
   $serializer = new Serializer([new ObjectNormalizer()], $encoders);

   $us = $serializer->deserialize($data, 'App\Entity\Utilisateur', 'json');
   $em= $this->getDoctrine()->getManager();
   $em->persist($us);
   $em->flush();
   $response = new Response('', Response::HTTP_CREATED);
   $response->headers->set('Content-Type', 'application/json');
   //Allow all websites
   $response->headers->set('Access-Control-Allow-Origin', '*');
   // You can set the allowed methods too, if you want
   $response->headers->set('Access-Control-Allow-Methods', '*');
   return $response;
}

/**
 * @Route("/updateuser/{id}", name="updateUser", methods={"put"})
 */
public function putGroupe(
    Utilisateur $utilisateur,
    Request $request,
    EntityManagerInterface $us,
    SerializerInterface $serializer
): Response
{
    $serializer->deserialize($request->getContent(),
    Utilisateur::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $utilisateur]
    );

    $us->flush();
    return new JsonResponse(
        $serializer->serialize($utilisateur, "json"),
        JsonResponse::HTTP_NO_CONTENT,
        [],
        true
    );
}

    /**
     * @Route("/{uid}", name="showuser", methods={"get"})
     */
    public function showuser($uid,utilisateurRepository $repository)  {
        $user=$repository->findOneBy(["uid" => $uid ]);
        
        $encoders= array(new JsonEncoder());
        $serializer= new Serializer([new ObjectNormalizer()],$encoders);
        //dd($serializer);
        $data = $serializer->serialize($user, 'json', ['circular_reference_handler'=>function($object){
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
