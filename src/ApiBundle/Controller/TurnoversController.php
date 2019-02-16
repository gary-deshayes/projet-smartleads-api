<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Turnovers;
use App\AdminBundle\Form\TurnoversType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/turnovers")
 */
class TurnoversController extends AbstractController
{
    /**
     * @Route("/", name="turnovers_index", methods={"GET"})
     */
    public function index(): Response
    {
        $turnovers = $this->getDoctrine()
            ->getRepository(Turnovers::class)
            ->findAll();

        return $this->render('turnovers/index.html.twig', [
            'turnovers' => $turnovers,
        ]);
    }

    /**
     * @Route("/new", name="turnovers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $turnover = new Turnovers();
        $form = $this->createForm(TurnoversType::class, $turnover);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($turnover);
            $entityManager->flush();

            return $this->redirectToRoute('turnovers_index');
        }

        return $this->render('turnovers/new.html.twig', [
            'turnover' => $turnover,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="turnovers_show", methods={"GET"})
     */
    public function show(Turnovers $turnover): Response
    {
        return $this->render('turnovers/show.html.twig', [
            'turnover' => $turnover,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="turnovers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Turnovers $turnover): Response
    {
        $form = $this->createForm(TurnoversType::class, $turnover);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('turnovers_index', [
                'id' => $turnover->getId(),
            ]);
        }

        return $this->render('turnovers/edit.html.twig', [
            'turnover' => $turnover,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="turnovers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Turnovers $turnover): Response
    {
        if ($this->isCsrfTokenValid('delete'.$turnover->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($turnover);
            $entityManager->flush();
        }

        return $this->redirectToRoute('turnovers_index');
    }
}
