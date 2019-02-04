<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\Country;
use App\ApiBundle\Form\CountryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("api/country")
 */
class CountryController extends AbstractController
{
   /**
     * Récupération d'une ville
     * @Route("/get/{id}", name="api_Country_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'une ville
     * @Route("/post", name="api_Country_post", methods={"POST"})
     */
    public function post(){

        $Country = new Country();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CountryType::class, $Country);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($Country);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition d'une ville
     * @Route("/edit/{id}", name="api_Country_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $Country = $em->getRepository(Country::class)->find($id);

        $form = $this->createForm(CountryType::class, $Country);

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
     * Suppression d'une ville
     * @Route("/delete/{id}", name="api_Country_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
