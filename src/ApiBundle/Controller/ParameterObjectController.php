<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\ParameterObject;
use App\ApiBundle\Form\ParameterObjectType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\ApiBundle\Repository\ParameterObjectRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("api/parameterObject")
 */
class ParameterObjectController extends AbstractController
{


    /**
     * Récupération d'un paramètre objet
     * @Route("/get/{id}", name="api_ParameterObject_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un paramètre objet
     * @Route("/post", name="api_ParameterObject_post", methods={"POST"})
     */
    public function post(){

        $ParameterObject = new ParameterObject();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ParameterObjectType::class, $ParameterObject);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ParameterObject);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }


    /**
     * Edition du paramètre objet
     * @Route("/edit/{id}", name="api_ParameterObject_edit", methods={"PUT"})
     */
    public function edit(){

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $ParameterObject = $em->getRepository(ParameterObject::class)->find($id);

        $form = $this->createForm(ParameterObjectType::class, $ParameterObject);

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
     * Suppression du paramètre objet
     * @Route("/delete/{id}", name="api_ParameterObject_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
