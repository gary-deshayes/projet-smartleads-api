<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\ContactCompanyService;
use App\ApiBundle\Form\ContactCompanyServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("api/contactCompanyService")
 */
class ContactCompanyServiceController extends AbstractController
{
    /**
     * Récupération du service d'un contact de l'entreprise
     * @Route("/get/{id}", name="api_ContactCompanyService_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création du service d'un contact de l'entreprise
     * @Route("/post", name="api_ContactCompanyService_post", methods={"POST"})
     */
    public function post(){

        $ContactCompanyService = new ContactCompanyService();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ContactCompanyServiceType::class, $ContactCompanyService);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ContactCompanyService);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition du service d'un contact de l'entreprise
     * @Route("/edit/{id}", name="api_ContactCompanyService_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $ContactCompanyService = $em->getRepository(ContactCompanyService::class)->find($id);

        $form = $this->createForm(ContactCompanyServiceType::class, $ContactCompanyService);

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
     * Suppression du service d'un contact de l'entreprise
     * @Route("/delete/{id}", name="api_ContactCompanyService_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
