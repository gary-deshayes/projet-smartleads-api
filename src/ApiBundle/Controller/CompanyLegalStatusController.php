<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\CompanyLegalStatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ApiBundle\Form\CompanyLegalStatusType;

/**
 * @Route("/companyLegalStatus")
 */
class CompanyLegalStatusController extends AbstractController
{
    
    /**
     * Récupération d'un statut d'entreprise
     * @Route("/get/{id}", name="api_companyLegalStatus_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un statut d'entreprise
     * @Route("/post", name="api_companyLegalStatus_post", methods={"POST"})
     */
    public function post(){

        $companyLegalStatus = new CompanyLegalStatus();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyLegalStatusType::class, $companyLegalStatus);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($companyLegalStatus);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition d'un statut d'entreprise 
     * @Route("/edit/{id}", name="api_companyLastTurnover_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $companyLegalStatus = $em->getRepository(CompanyLegalStatus::class)->find($id);

        $form = $this->createForm(CompanyLegalStatusType::class, $companyLegalStatus);

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
     * Suppression d'un statut d'entreprise
     * @Route("/delete/{id}", name="api_companyLegalStatus_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
