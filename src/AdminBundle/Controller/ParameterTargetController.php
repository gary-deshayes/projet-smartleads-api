<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ParameterTarget;
use App\AdminBundle\Form\ParameterTargetType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Repository\ParameterTargetRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/ParameterTarget")
 */
class ParameterTargetController extends AbstractController
{


    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="ParameterTarget_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ParameterTarget = $em->getRepository(ParameterTarget::class)->find($id);

        $form = $this->createForm(ParameterTargetType::class, $ParameterTarget);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($ParameterTarget->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("ParameterTarget");
            } else {
                return $this->render('parameter_target/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$ParameterTarget) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('parameter_target/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="ParameterTarget_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

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
     * Affichage du formulaire
     * @Route("delete/{id}", name="ParameterTarget_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression de l'entreprise
     * @Route("/", name="ParameterTarget_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="ParameterTarget_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(ParameterTargetType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('ParameterTarget');
            } else {
                return $this->render('parameter_target/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('parameter_target/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="ParameterTarget_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

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
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="ParameterTarget", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(ParameterTarget::class);
        $ParameterTarget = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($ParameterTarget, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('parameter_target/index.html.twig', array(
                "ParameterTarget" => $ParameterTarget
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="ParameterTarget_success", methods={"POST"})
     */
    public function success()
    {

    }
}
