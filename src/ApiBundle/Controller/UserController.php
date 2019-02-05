<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\User;
use App\AdminBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("api/user")
 */
class UserController extends AbstractController
{
    /**
     * Récupération d'un user
     * @Route("/get/{id}", name="api_User_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un user
     * @Route("/post", name="api_User_post", methods={"POST"})
     */
    public function post(){

        $user = new User();
        $response = new Response();

        $json = $serializer->serialize(
            $user,
            'json',
            ['Groups'=>["Light"]]
        );

        $formCreate = $this->createForm(UserType::class);
        $formCreate->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/JSON');
        return $response;

    }


    /**
     * Edition de l'user
     * @Route("/edit/{id}", name="api_User_edit", methods={"PUT"})
     */
    public function edit(){

    }

    /**
     * Suppression de l'user
     * @Route("/delete/{id}", name="api_User_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
