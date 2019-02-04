<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ParameterGraphicStyles;
use App\AdminBundle\Form\ParameterGraphicStylesType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Repository\ParameterGraphicStylesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin/parameterGraphicStyles")
 */
class ParameterGraphicStylesController extends AbstractController
{


    /**
     * Edition d'un paramètre de style graphique par twig
     * @Route("/edit/{id}", name="ParameterGraphicStyles_edit", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
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
     * Suppression d'un paramètre de style graphique par twig
     * @Route("delete/{id}", name="ParameterGraphicStyles_delete", methods={"GET"})
     */
    public function delete()
    {

    }

    /**
     * Création d'un paramètre de style graphique par twig
     * @Route("/new", name="ParameterGraphicStyles_new", methods={"GET","POST"})
     */
    public function new(Request $request)
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
     * Affichage de la liste des paramètres de style graphique par twig
     * @Route("/", name="ParameterGraphicStyles_index", methods={"GET"})
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
     * Affichage d'un message en cas de succès d'une requête
     * @Route("/success", name="ParameterGraphicStyles_success", methods={"GET"})
     */
    public function success()
    {

    }
}
