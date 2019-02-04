<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\Contact;
use App\ApiBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("api/contact")
 */
class ContactController extends AbstractController
{
    /**
     * Récupération d'un conctact
     * @Route("/get/{id}", name="api_Contact_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un contact
     * @Route("/post", name="api_Contact_post", methods={"POST"})
     */
    public function post(){

        $Contact = new Contact();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ContactType::class, $Contact);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($Contact);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition d'un contact
     * @Route("/edit/{id}", name="api_Contact_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $Contact = $em->getRepository(Contact::class)->find($id);

        $form = $this->createForm(ContactType::class, $Contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");
        return $response;

    }

    /**
     * Suppression d'un contact
     * @Route("/delete/{id}", name="api_Contact_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
