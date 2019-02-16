<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\SiteType;
use App\AdminBundle\Form\SiteTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/site/type")
 */
class SiteTypeController extends AbstractController
{
    /**
     * @Route("/", name="site_type_index", methods={"GET"})
     */
    public function index(): Response
    {
        $siteTypes = $this->getDoctrine()
            ->getRepository(SiteType::class)
            ->findAll();

        return $this->render('site_type/index.html.twig', [
            'site_types' => $siteTypes,
        ]);
    }

    /**
     * @Route("/new", name="site_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $siteType = new SiteType();
        $form = $this->createForm(SiteTypeType::class, $siteType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($siteType);
            $entityManager->flush();

            return $this->redirectToRoute('site_type_index');
        }

        return $this->render('site_type/new.html.twig', [
            'site_type' => $siteType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="site_type_show", methods={"GET"})
     */
    public function show(SiteType $siteType): Response
    {
        return $this->render('site_type/show.html.twig', [
            'site_type' => $siteType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="site_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SiteType $siteType): Response
    {
        $form = $this->createForm(SiteTypeType::class, $siteType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('site_type_index', [
                'id' => $siteType->getId(),
            ]);
        }

        return $this->render('site_type/edit.html.twig', [
            'site_type' => $siteType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="site_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SiteType $siteType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$siteType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($siteType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('site_type_index');
    }
}
