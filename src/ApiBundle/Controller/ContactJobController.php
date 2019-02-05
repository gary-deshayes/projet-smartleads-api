<?php

namespace App\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/contactJob")
 */
class ContactJobController extends AbstractController
{
    /**
     * Récupération du métier d'un contact
     * @Route("/get/{id}", name="api_ContactJob_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création du métier d'un contact
     * @Route("/post", name="api_ContactJob_post", methods={"POST"})
     */
    public function post(){

        $ContactJob = new ContactJob();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ContactJobType::class, $ContactJob);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ContactJob);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition du métier d'un contact
     * @Route("/edit/{id}", name="api_ContactJob_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $ContactJob = $em->getRepository(ContactJob::class)->find($id);

        $form = $this->createForm(ContactJobType::class, $ContactJob);

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
     * Suppression du métier d'un contact
     * @Route("/delete/{id}", name="api_ContactJob_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
