<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\CompanyNbEmployees;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ApiBundle\Form\CompanyNbEmployeesType;

/**
 * @Route("api/companyNbEmployees")
 */
class CompanyNbEmployeesController extends AbstractController
{
    
  /**
     * Récupération d'un nombre d'employe d'une entreprise 
     * @Route("/get/{id}", name="api_companyNbEmployees_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un nombre d'employe d'une entreprise 
     * @Route("/post", name="api_companyNbEmployees_post", methods={"POST"})
     */
    public function post(){

        $companyNbEmployees = new CompanyNbEmployees();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyNbEmployeesType::class, $companyNbEmployees);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($companyNbEmployees);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition d'un nombre d'employe d'une entreprise 
     * @Route("/edit/{id}", name="api_companyNbEmployees_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $companyNbEmployees = $em->getRepository(CompanyNbEmployees::class)->find($id);

        $form = $this->createForm(CompanyNbEmployeesType::class, $companyNbEmployees);

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
     * Suppression d'un nombre d'employe d'une entreprise 
     * @Route("/delete/{id}", name="api_companyNbEmployees_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
