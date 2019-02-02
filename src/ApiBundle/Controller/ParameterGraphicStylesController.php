<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\ParameterGraphicStyles;
use App\ApiBundle\Form\ParameterGraphicStylesType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\ApiBundle\Repository\ParameterGraphicStylesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/parameterGraphicStyles")
 */
class ParameterGraphicStylesController extends AbstractController
{


    /**
     * Récupération d'un paramètre de style graphique
     * @Route("/get/{id}", name="api_ParameterGraphicStyles_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un paramètre de style graphique
     * @Route("/post", name="api_ParameterGraphicStyles_post", methods={"POST"})
     */
    public function post(){

        $ParameterGraphicStyles = new ParameterGraphicStyles();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ParameterGraphicStylesType::class, $ParameterGraphicStyles);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ParameterGraphicStyles);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition du paramètre de style graphique
     * @Route("/edit/{id}", name="api_ParameterGraphicStyles_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $ParameterGraphicStyles = $em->getRepository(ParameterGraphicStyles::class)->find($id);

        $form = $this->createForm(ParameterGraphicStylesType::class, $ParameterGraphicStyles);

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
     * Suppression du paramètre de style graphique
     * @Route("/delete/{id}", name="api_ParameterGraphicStyles_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
