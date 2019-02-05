<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\Company;
use App\ApiBundle\Form\CompanyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/company")
*/
class CompanyController extends AbstractController
{

 /**
     * Récupération d'une entreprise 
     * @Route("/get/{id}", name="api_company_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'une entreprise
     * @Route("/post", name="api_company_post", methods={"POST"})
     */
    public function post(){

        $company = new Company();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyType::class, $company);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition d'une entreprise
     * @Route("/edit/{id}", name="api_company_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository(Company::class)->find($id);

        $form = $this->createForm(CompanyType::class, $company);

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
     * Suppression d'une entreprise
     * @Route("/delete/{id}", name="api_company_delete", methods={"DELETE"})
     */
    public function delete(){

    }

}
