<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Form\OperationsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operations")
 */
class OperationsController extends AbstractController
{
    /**
     * @Route("/", name="operations_index", methods={"GET"})
     */
    public function index(): Response
    {
        $operations = $this->getDoctrine()
            ->getRepository(Operations::class)
            ->findAll();

        return $this->render('operations/index.html.twig', [
            'operations' => $operations,
        ]);
    }

    /**
     * @Route("/new", name="operations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $operation = new Operations();
        $form = $this->createForm(OperationsType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($operation);
            $entityManager->flush();

            return $this->redirectToRoute('operations_index');
        }

        return $this->render('operations/new.html.twig', [
            'operation' => $operation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{name}", name="operations_show", methods={"GET"})
     */
    public function show(Operations $operation): Response
    {
        return $this->render('operations/show.html.twig', [
            'operation' => $operation,
        ]);
    }

    /**
     * @Route("/{name}/edit", name="operations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Operations $operation): Response
    {
        $form = $this->createForm(OperationsType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operations_index', [
                'name' => $operation->getName(),
            ]);
        }

        return $this->render('operations/edit.html.twig', [
            'operation' => $operation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{name}", name="operations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Operations $operation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$operation->getName(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operations_index');
    }
}
