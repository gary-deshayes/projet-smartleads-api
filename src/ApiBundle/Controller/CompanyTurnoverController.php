<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\CompanyTurnover;
use App\ApiBundle\Form\CompanyTurnoverType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("companyTurnover")
 */
class CompanyTurnoverController extends AbstractController
{
    

    /**
     * Récupération d'un chiffre d'affaire
     * @Route("/get/{id}", name="api_CompanyTurnover_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un chiffre d'affaire
     * @Route("/post", name="api_CompanyTurnover_post", methods={"POST"})
     */
    public function post(){

        $CompanyTurnover = new CompanyTurnover();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyTurnoverType::class, $CompanyTurnover);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($CompanyTurnover);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition du chiffre d'affaire
     * @Route("/edit/{id}", name="api_CompanyTurnover_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $CompanyTurnover = $em->getRepository(CompanyTurnover::class)->find($id);

        $form = $this->createForm(CompanyTurnoverType::class, $CompanyTurnover);

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
     * Suppression du chiffre d'ffaire
     * @Route("/delete/{id}", name="api_CompanyTurnover_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
