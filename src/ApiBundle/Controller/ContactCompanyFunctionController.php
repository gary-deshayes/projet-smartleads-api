<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\ContactCompanyFunction;
use App\ApiBundle\Form\ContactCompanyFunctionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/contactCompanyFunction")
 */
class ContactCompanyFunctionController extends AbstractController
{
     /**
     * Récupération de la fonction de l'entreprise d'un contact
     * @Route("/get/{id}", name="api_ContactCompanyFunction_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création de la fonction de l'entreprise d'un contact
     * @Route("/post", name="api_ContactCompanyFunction_post", methods={"POST"})
     */
    public function post(){

        $ContactCompanyFunction = new ContactCompanyFunction();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ContactCompanyFunctionType::class, $ContactCompanyFunction);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ContactCompanyFunction);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition de la fonction de l'entreprise d'un contact
     * @Route("/edit/{id}", name="api_ContactCompanyFunction_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $ContactCompanyFunction = $em->getRepository(ContactCompanyFunction::class)->find($id);

        $form = $this->createForm(ContactCompanyFunctionType::class, $ContactCompanyFunction);

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
     * Suppression de la fonction de l'entreprise d'un contact
     * @Route("/delete/{id}", name="api_ContactCompanyFunction_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
