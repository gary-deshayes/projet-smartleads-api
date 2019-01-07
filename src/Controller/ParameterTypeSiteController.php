<?php

namespace App\Controller;

use App\Entity\ParameterTypeSite;
use App\Form\ParameterTypeSiteType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ParameterTypeSiteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/ParameterTypeSite")
 */
class ParameterTypeSiteController extends AbstractController
{


    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="ParameterTypeSite_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ParameterTypeSite = $em->getRepository(ParameterTypeSite::class)->find($id);

        $form = $this->createForm(ParameterTypeSiteType::class, $ParameterTypeSite);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($ParameterTypeSite->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("ParameterTypeSite");
            } else {
                return $this->render('parameter_type_site/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$ParameterTypeSite) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('parameter_type_site/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="ParameterTypeSite_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

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
     * Affichage du formulaire
     * @Route("delete/{id}", name="ParameterTypeSite_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression de l'entreprise
     * @Route("/", name="ParameterTypeSite_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="ParameterTypeSite_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(ParameterTypeSiteType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('ParameterTypeSite');
            } else {
                return $this->render('parameter_type_site/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('parameter_type_site/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="ParameterTypeSite_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

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
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="ParameterTypeSite", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(ParameterTypeSite::class);
        $ParameterTypeSite = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($ParameterTypeSite, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('parameter_type_site/index.html.twig', array(
                "ParameterTypeSite" => $ParameterTypeSite
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="ParameterTypeSite_success", methods={"POST"})
     */
    public function success()
    {

    }
}
