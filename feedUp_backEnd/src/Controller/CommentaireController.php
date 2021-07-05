<?php

namespace App\Controller;

use App\Repository\CommentaireRepository;
use DateTime;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $data = $serializer->serialize($list, 'json', ['groups'=>'comment:read']);
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
        $comment->setCDatePublication(new DateTime());
        $em= $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
        dd($comment);
        $response = new Response('', Response::HTTP_CREATED);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'POST');
        return $response;

    }


    /**
    * @Route("/delComment", name="delComment", methods={"DELETE"})
    * @return Response
    */
    public function deleteComment($id): Response
   {
       $em = $this->getDoctrine()->getManager();
       $comment = $em->getRepository(Commentaire::class)->find($id);
       $em->remove($comment);
       $em->flush();
       $response = new Response('', Response::HTTP_OK);
       dd($response);
       //Allow all websites
       $response->headers->set('Access-Control-Allow-Origin', '*');
       // You can set the allowed methods too, if you want
       $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
       return $response;
   }


/**
* @Route("/editComment", name="editComment", methods={"PUT"})
*
*/   

public  function updateComment(Request $request, $id)
{
    $data = $request->getContent();
    $encoders = array(new JsonEncoder());
    $serializer = new Serializer([new ObjectNormalizer()], $encoders);
    //dd($serializer);
    $c1 = $serializer->deserialize($data, 'App\Entity\Commentaire', 'json');
    dd($c1);
    $c0 = $this->em->getRepository(Commentaire::class)->find($id);
    $c0 = $c1;
    //dd($c0);
    $this->em->flush();
    $response = new Response('', Response::HTTP_OK);
    //Allow all websites
    $response->headers->set('Access-Control-Allow-Origin', '*');
    // You can set the allowed methods too, if you want
    $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
    //dd($response);
    return $response;
    

} 
}
