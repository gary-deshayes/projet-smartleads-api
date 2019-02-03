<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\CompanyActivityArea;
use App\ApiBundle\Form\CompanyActivityAreaType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\ApiBundle\Repository\ParameterTargetRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("companyActivityArea")
 */
class CompanyActivityAreaController extends AbstractController
{
    

    /**
     * Récupération d'une zone d'activité de l'entreprise 
     * @Route("/get/{id}", name="api_companyActivityArea_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'une zone d'activité de l'entreprise
     * @Route("/post", name="api_companyActivityArea_post", methods={"POST"})
     */
    public function post(){

        $companyActivityArea = new CompanyActivityArea();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyActivityAreaType::class, $companyActivityArea);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($companyActivityArea);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition d'une zone d'activité de l'entreprise
     * @Route("/edit/{id}", name="api_companyActivityArea_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $companyActivityArea = $em->getRepository(CompanyActivityArea::class)->find($id);

        $form = $this->createForm(CompanyActivityAreaType::class, $companyActivityArea);

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
     * Suppression d'une zone d'activité de l'entreprise
     * @Route("/delete/{id}", name="api_companyActivityArea_delete", methods={"DELETE"})
     */
    public function delete(){

    }

}
