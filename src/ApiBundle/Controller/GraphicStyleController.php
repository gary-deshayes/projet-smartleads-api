<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\GraphicStyle;
use App\AdminBundle\Form\GraphicStyleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/graphic/style")
 */
class GraphicStyleController extends AbstractController
{
    /**
     * @Route("/", name="graphic_style_index", methods={"GET"})
     */
    public function index(): Response
    {
        $graphicStyles = $this->getDoctrine()
            ->getRepository(GraphicStyle::class)
            ->findAll();

        return $this->render('graphic_style/index.html.twig', [
            'graphic_styles' => $graphicStyles,
        ]);
    }

    /**
     * @Route("/new", name="graphic_style_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $graphicStyle = new GraphicStyle();
        $form = $this->createForm(GraphicStyleType::class, $graphicStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($graphicStyle);
            $entityManager->flush();

            return $this->redirectToRoute('graphic_style_index');
        }

        return $this->render('graphic_style/new.html.twig', [
            'graphic_style' => $graphicStyle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="graphic_style_show", methods={"GET"})
     */
    public function show(GraphicStyle $graphicStyle): Response
    {
        return $this->render('graphic_style/show.html.twig', [
            'graphic_style' => $graphicStyle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="graphic_style_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GraphicStyle $graphicStyle): Response
    {
        $form = $this->createForm(GraphicStyleType::class, $graphicStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('graphic_style_index', [
                'id' => $graphicStyle->getId(),
            ]);
        }

        return $this->render('graphic_style/edit.html.twig', [
            'graphic_style' => $graphicStyle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="graphic_style_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GraphicStyle $graphicStyle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$graphicStyle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($graphicStyle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('graphic_style_index');
    }
}
