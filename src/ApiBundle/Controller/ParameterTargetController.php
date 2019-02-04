<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\ParameterTarget;
use App\ApiBundle\Form\ParameterTargetType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\ApiBundle\Repository\ParameterTargetRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("api/parameterTarget")
 */
class ParameterTargetController extends AbstractController
{


    /**
     * Récupération d'un paramètre cible
     * @Route("/get/{id}", name="api_ParameterTarget_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un paramètre cible
     * @Route("/post", name="api_ParameterTarget_post", methods={"POST"})
     */
    public function post(){

        $ParameterTarget = new ParameterTarget();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ParameterTargetType::class, $ParameterTarget);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ParameterTarget);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition du paramètre cible
     * @Route("/edit/{id}", name="api_ParameterTarget_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $ParameterTarget = $em->getRepository(ParameterTarget::class)->find($id);

        $form = $this->createForm(ParameterTargetType::class, $ParameterTarget);

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
     * Suppression du paramètre cible
     * @Route("/delete/{id}", name="api_ParameterTarget_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
