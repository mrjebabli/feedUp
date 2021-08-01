<?php

namespace App\Controller;

use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentaireRepository;
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
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;



class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire/getComment", name="getComment", methods={"GET"})
     */
    public function getCommentaire(CommentaireRepository $repo, SerializerInterface $serializer): Response
    {
        $list=$repo->findAll();
       //permet a serializer l'object extracter de BD uniquement l'atribut evenement pour eliminer la criculisation
       //$encoders = array(new JsonEncoder());
       //$serializer = new Serializer([new ObjectNormalizer()], $encoders);
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
    * @Route("/commentaire/addComment", name="addComment", methods={"POST"})
    * @return Response
    */
    public function addComment(Request $req, SerializerInterface $serializer): Response
    {
       
        $data=$req->getContent();
        $comment = $serializer->deserialize($data, 'App\Entity\Commentaire', 'json');
        $em= $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
        $response = new Response('', Response::HTTP_CREATED);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'POST');
        return $response;

    }


    /**
    * @Route("/commentaire/{id}/delete", name="delComment", methods={"delete"})
    * @return Response
    */
    public function deleteComment($id): Response
   {
       $em = $this->getDoctrine()->getManager();
       $comment = $em->getRepository(Commentaire::class)->find($id);
       $em->remove($comment);
       $em->flush();
       $response = new Response('', Response::HTTP_OK);
       //Allow all websites
       $response->headers->set('Access-Control-Allow-Origin', '*');
       // You can set the allowed methods too, if you want
       $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
       return $response;
   }



/** 
    * @Route("/commentaire/update/{id}", name="updateC", methods={"PUT"})
    */

    public function updateC(Commentaire $event, Request $request, EntityManagerInterface $em, 
    SerializerInterface $serializer ): Response
    {
        $serializer->deserialize($request->getContent(), Commentaire::class, 'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $event]
        );

        $em->flush();

        return new JsonResponse($serializer->serialize($event, "json") ,
        
        JsonResponse::HTTP_NO_CONTENT, [], true );

    }

}
