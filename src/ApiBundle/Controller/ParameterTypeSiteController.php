<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\ParameterTypeSite;
use App\ApiBundle\Form\ParameterTypeSiteType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\ApiBundle\Repository\ParameterTypeSiteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("parameterTypeSite")
 */
class ParameterTypeSiteController extends AbstractController
{


    /**
     * Récupération d'un paramètre type de site
     * @Route("/get/{id}", name="api_ParameterTypeSite_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un paramètre type de site
     * @Route("/post", name="api_ParameterTypeSite_post", methods={"POST"})
     */
    public function post(){

        $ParameterTypeSite = new ParameterTypeSite();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ParameterTypeSiteType::class, $ParameterTypeSite);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ParameterTypeSite);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition du paramètre type de site
     * @Route("/edit/{id}", name="api_ParameterTypeSite_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $ParameterTypeSite = $em->getRepository(ParameterTypeSite::class)->find($id);

        $form = $this->createForm(ParameterTypeSiteType::class, $ParameterTypeSite);

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
     * Suppression du paramètre type de site
     * @Route("/delete/{id}", name="api_ParameterTypeSite_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
