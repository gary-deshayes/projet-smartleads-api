<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\DecisionMaking;
use App\AdminBundle\Form\DecisionMakingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/decisionMaking")
 */
class DecisionMakingController extends AbstractController
{

    /**
     * @Route("/new", name="decisionMaking_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $decision = new DecisionMaking();
        $form = $this->createForm(DecisionMakingType::class, $decision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($decision);
            $entityManager->flush();

            return $this->redirectToRoute('settings_index');
        }

        return $this->render('decision/new.html.twig', [
            'decision' => $decision,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="decisionMaking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DecisionMaking $decision): Response
    {
        $form = $this->createForm(DecisionMakingType::class, $decision);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('decisionMaking_index', [
                'id' => $decision->getId(),
            ]);
        }

        return $this->render('decision_making/edit.html.twig', [
            'decision' => $decision,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="decisionMaking_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DecisionMaking $decision): Response
    {
        if ($this->isCsrfTokenValid('delete'.$decision->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($decision);
            $entityManager->flush();
        }

        return $this->redirectToRoute('settings_index');
    }
}
