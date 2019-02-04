<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\CompanyLastTurnover;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ApiBundle\Form\CompanyLastTurnoverType;

/**
 * @Route("companyLastTurnover")
 */
class CompanyLastTurnoverController extends AbstractController
{
    
/**
     * Récupération d'un dernier chiffre d'affaire d'une entreprise 
     * @Route("/get/{id}", name="api_companyLastTurnover_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création du dernier chiffre d'affaire d'une entreprise 
     * @Route("/post", name="api_companyLastTurnover_post", methods={"POST"})
     */
    public function post(){

        $companyLastTurnover = new CompanyLastTurnover();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyLastTurnoverType::class, $companyLastTurnover);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($companyLastTurnover);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition du dernier chiffre d'affaire d'une entreprise 
     * @Route("/edit/{id}", name="api_companyLastTurnover_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $companyLastTurnover = $em->getRepository(CompanyLastTurnover::class)->find($id);

        $form = $this->createForm(CompanyLastTurnoverType::class, $companyLastTurnover);

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
     * Suppression du dernier chiffre d'affaire d'une entreprise 
     * @Route("/delete/{id}", name="api_companyLastTurnover_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
