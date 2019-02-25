<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Behavior;
use App\AdminBundle\Form\BehaviorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/behavior")
 */
class BehaviorController extends AbstractController
{
    /**
     * @Route("/", name="behavior_index", methods={"GET"})
     */
    public function index(): Response
    {
        $behaviors = $this->getDoctrine()
            ->getRepository(Behavior::class)
            ->findAll();

        return $this->render('behavior/index.html.twig', [
            'behaviors' => $behaviors,
        ]);
    }

    /**
     * @Route("/new", name="behavior_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $behavior = new Behavior();
        $form = $this->createForm(BehaviorType::class, $behavior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($behavior);
            $entityManager->flush();

            return $this->redirectToRoute('behavior_index');
        }

        return $this->render('behavior/new.html.twig', [
            'behavior' => $behavior,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="behavior_show", methods={"GET"})
     */
    public function show(Behavior $behavior): Response
    {
        return $this->render('behavior/show.html.twig', [
            'behavior' => $behavior,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="behavior_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Behavior $behavior): Response
    {
        $form = $this->createForm(BehaviorType::class, $behavior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('behavior_index', [
                'id' => $behavior->getId(),
            ]);
        }

        return $this->render('behavior/edit.html.twig', [
            'behavior' => $behavior,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="behavior_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Behavior $behavior): Response
    {
        if ($this->isCsrfTokenValid('delete'.$behavior->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($behavior);
            $entityManager->flush();
        }

        return $this->redirectToRoute('behavior_index');
    }
}
