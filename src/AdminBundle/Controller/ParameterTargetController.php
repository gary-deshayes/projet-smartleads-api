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
 * @Route("/parameterTarget")
 */
class ParameterTargetController extends AbstractController
{


    /**
     * Edition d'un paramètre de cible par twig
     * @Route("/edit/{id}", name="ParameterTarget_edit", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
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
     * Suppression d'un paramètre de cible par twig
     * @Route("delete/{id}", name="ParameterTarget_delete", methods={"GET"})
     */
    public function delete()
    {

    }

    /**
     * Création d'un paramètre de cible par twig
     * @Route("/new", name="ParameterTarget_new", methods={"GET","POST"})
     */
    public function new(Request $request)
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
     * Affichage de la liste des paramètres de cible par twig
     * @Route("/", name="ParameterTarget_index", methods={"GET"})
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
     * Affichage d'un message en cas du succès d'une requête
     * @Route("/success", name="ParameterTarget_success", methods={"GET"})
     */
    public function success()
    {

    }
}
