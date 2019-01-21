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
 * @Route("/ParameterGraphicStyles")
 */
class ParameterGraphicStylesController extends AbstractController
{


    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="ParameterGraphicStyles_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ParameterGraphicStyles = $em->getRepository(ParameterGraphicStyles::class)->find($id);

        $form = $this->createForm(ParameterGraphicStylesType::class, $ParameterGraphicStyles);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($ParameterGraphicStyles->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("ParameterGraphicStyles");
            } else {
                return $this->render('parameter_graphic_styles/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$ParameterGraphicStyles) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('parameter_graphic_styles/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="ParameterGraphicStyles_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

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
     * Affichage du formulaire
     * @Route("delete/{id}", name="ParameterGraphicStyles_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression de l'entreprise
     * @Route("/", name="ParameterGraphicStyles_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="ParameterGraphicStyles_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(ParameterGraphicStylesType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('ParameterGraphicStyles');
            } else {
                return $this->render('parameter_graphic_styles/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('parameter_graphic_styles/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="ParameterGraphicStyles_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

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
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="ParameterGraphicStyles", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(ParameterGraphicStyles::class);
        $ParameterGraphicStyles = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($ParameterGraphicStyles, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('parameter_graphic_styles/index.html.twig', array(
                "ParameterGraphicStyles" => $ParameterGraphicStyles
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="ParameterGraphicStyles_success", methods={"POST"})
     */
    public function success()
    {

    }
}
