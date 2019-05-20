<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Profession;
use App\AdminBundle\Form\ProfessionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profession")
 */
class ProfessionController extends AbstractController
{

    /**
     * @Route("/new", name="profession_new", methods={"GET","POST"})
     */
    function new (Request $request): Response {
        $profession = new Profession();
        $form = $this->createForm(ProfessionType::class, $profession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profession);
            $entityManager->flush();

            return $this->redirectToRoute('settings_index');
        }

        return $this->render('profession/new.html.twig', [
            'profession' => $profession,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="profession_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Profession $profession): Response
    {
        $form = $this->createForm(ProfessionType::class, $profession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profession_index', [
                'id' => $profession->getId(),
            ]);
        }

        return $this->render('profession/edit.html.twig', [
            'profession' => $profession,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="profession_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Profession $profession): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($profession);
        $entityManager->flush();
        $response = new Response(json_encode(1));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
