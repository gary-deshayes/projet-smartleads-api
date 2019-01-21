<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ParameterObject;
use App\AdminBundle\Form\ParameterObjectType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Repository\ParameterObjectRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/ParameterObject")
 */
class ParameterObjectController extends AbstractController
{


    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="ParameterObject_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ParameterObject = $em->getRepository(ParameterObject::class)->find($id);

        $form = $this->createForm(ParameterObjectType::class, $ParameterObject);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($ParameterObject->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("ParameterObject");
            } else {
                return $this->render('parameter_object/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$ParameterObject) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('parameter_object/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="ParameterObject_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

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
     * Affichage du formulaire
     * @Route("delete/{id}", name="ParameterObject_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression de l'entreprise
     * @Route("/", name="ParameterObject_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="ParameterObject_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(ParameterObjectType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('ParameterObject');
            } else {
                return $this->render('parameter_object/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('parameter_object/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="ParameterObject_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

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
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="ParameterObject", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(ParameterObject::class);
        $ParameterObject = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($ParameterObject, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('parameter_object/index.html.twig', array(
                "ParameterObject" => $ParameterObject
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="ParameterObject_success", methods={"POST"})
     */
    public function success()
    {

    }
}
