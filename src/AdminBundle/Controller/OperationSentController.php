<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\OperationSent;
use App\AdminBundle\Form\OperationSentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operation/sent")
 */
class OperationSentController extends AbstractController
{
    /**
     * @Route("/", name="operation_sent_index", methods={"GET"})
     */
    public function index(): Response
    {
        $operationSents = $this->getDoctrine()
            ->getRepository(OperationSent::class)
            ->findAll();

        return $this->render('operation_sent/index.html.twig', [
            'operation_sents' => $operationSents,
        ]);
    }

    /**
     * @Route("/new", name="operation_sent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $operationSent = new OperationSent();
        $form = $this->createForm(OperationSentType::class, $operationSent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($operationSent);
            $entityManager->flush();

            return $this->redirectToRoute('operation_sent_index');
        }

        return $this->render('operation_sent/new.html.twig', [
            'operation_sent' => $operationSent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSalesperson}", name="operation_sent_show", methods={"GET"})
     */
    public function show(OperationSent $operationSent): Response
    {
        return $this->render('operation_sent/show.html.twig', [
            'operation_sent' => $operationSent,
        ]);
    }

    /**
     * @Route("/{idSalesperson}/edit", name="operation_sent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OperationSent $operationSent): Response
    {
        $form = $this->createForm(OperationSentType::class, $operationSent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operation_sent_index', [
                'idSalesperson' => $operationSent->getIdSalesperson(),
            ]);
        }

        return $this->render('operation_sent/edit.html.twig', [
            'operation_sent' => $operationSent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSalesperson}", name="operation_sent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OperationSent $operationSent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$operationSent->getIdSalesperson(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operationSent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operation_sent_index');
    }
}
