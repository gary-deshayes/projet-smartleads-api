<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\LegalStatus;
use App\AdminBundle\Form\LegalStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/legalstatus")
 */
class LegalStatusController extends AbstractController
{
    /**
     * @Route("/", name="legal_status_index", methods={"GET"})
     */
    public function index(): Response
    {
        $legalStatuses = $this->getDoctrine()
            ->getRepository(LegalStatus::class)
            ->findAll();

        return $this->render('legal_status/index.html.twig', [
            'legal_statuses' => $legalStatuses,
        ]);
    }

    /**
     * @Route("/new", name="legal_status_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $legalStatus = new LegalStatus();
        $form = $this->createForm(LegalStatusType::class, $legalStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($legalStatus);
            $entityManager->flush();

            return $this->redirectToRoute('legal_status_index');
        }

        return $this->render('legal_status/new.html.twig', [
            'legal_status' => $legalStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="legal_status_show", methods={"GET"})
     */
    public function show(LegalStatus $legalStatus): Response
    {
        return $this->render('legal_status/show.html.twig', [
            'legal_status' => $legalStatus,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="legal_status_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LegalStatus $legalStatus): Response
    {
        $form = $this->createForm(LegalStatusType::class, $legalStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('legal_status_index', [
                'id' => $legalStatus->getId(),
            ]);
        }

        return $this->render('legal_status/edit.html.twig', [
            'legal_status' => $legalStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="legal_status_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LegalStatus $legalStatus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$legalStatus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($legalStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('legal_status_index');
    }
}
