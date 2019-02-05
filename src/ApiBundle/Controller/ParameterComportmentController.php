<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\ParameterComportment;
use App\ApiBundle\Form\ParameterComportmentType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\ApiBundle\Repository\ParameterComportmentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/parameterComportment")
 */
class ParameterComportmentController extends AbstractController
{
    /**
     * Edit des données
     * @Route("/{id}", name="ParameterComportment_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $ParameterComportment = $em->getRepository(ParameterComportment::class)->find($id);

        $form = $this->createForm(ParameterComportmentType::class, $ParameterComportment);

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
     * Suppression de l'entreprise
     * @Route("/", name="ParameterComportment_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/", name="ParameterComportment_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

        $ParameterComportment = new ParameterComportment();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ParameterComportmentType::class, $ParameterComportment);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ParameterComportment);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }

    /**
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="ParameterComportment", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(ParameterComportment::class);
        $ParameterComportment = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($ParameterComportment, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('parameter_comportment/index.html.twig', array(
                "ParameterComportment" => $ParameterComportment
            ));
        }
    }
}
