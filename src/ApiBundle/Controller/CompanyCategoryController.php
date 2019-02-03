<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\CompanyCategory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ApiBundle\Form\CompanyCategoryType;

/**
 * @Route("companyCategory")
 */
class CompanyCategoryController extends AbstractController
{
    
 /**
     * Récupération d'une zone d'activité d'une l'entreprise 
     * @Route("/get/{id}", name="api_companyCategory_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création dd'une zone d'activité d'une l'entreprise 
     * @Route("/post", name="api_companyCategory_post", methods={"POST"})
     */
    public function post(){

        $companyCategory = new CompanyCategory();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyCategoryType::class, $companyCategory);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($companyCategory);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition d'une zone d'activité d'une l'entreprise 
     * @Route("/edit/{id}", name="api_companyCategory_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $companyCategory = $em->getRepository(CompanyCategory::class)->find($id);

        $form = $this->createForm(CompanyCategoryType::class, $companyCategory);

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
     * Suppression d'une zone d'activité d'une l'entreprise 
     * @Route("/delete/{id}", name="api_companyCategory_delete", methods={"DELETE"})
     */
    public function delete(){

    }

}
