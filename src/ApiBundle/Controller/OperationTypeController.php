<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\Operation;
use App\ApiBundle\Form\OperationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("api/operation")
 */
class OperationTypeController extends AbstractController
{
    /**
     * Edit des données
     * @Route("/{id}", name="operation_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $CompanyTurnover = $em->getRepository(Operation::class)->find($id);

        $form = $this->createForm(OperationType::class, $CompanyTurnover);

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
     * Suppression du secteur
     * @Route("/", name="operation_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/", name="operation_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

        $operation = new Operation();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(OperationType::class, $operation);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($operation);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }

    /**
     * Affichage de la liste de nombre d'employées
     * @Route("/", name="operation", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(Operation::class);
        $operation = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($operation, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('operation/index.html.twig', array(
                "operations" => $operation
            ));
        }
    }
}
