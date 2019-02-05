<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ParameterComportment;
use App\AdminBundle\Form\ParameterComportmentType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Repository\ParameterComportmentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/parameterComportment")
 */
class ParameterComportmentController extends AbstractController
{
    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="ParameterComportment_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ParameterComportment = $em->getRepository(ParameterComportment::class)->find($id);

        $form = $this->createForm(ParameterComportmentType::class, $ParameterComportment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($ParameterComportment->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("ParameterComportment");
            } else {
                return $this->render('parameter_comportment/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$ParameterComportment) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('parameter_comportment/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Affichage du formulaire
     * @Route("delete/{id}", name="ParameterComportment_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="ParameterComportment_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(ParameterComportmentType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('ParameterComportment');
            } else {
                return $this->render('parameter_comportment/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('parameter_comportment/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
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

    /**
     * Affichage du formulaire
     * @Route("/success", name="ParameterComportment_success", methods={"GET"})
     */
    public function success()
    {

    }
}
