<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ObjectTable;
use App\AdminBundle\Form\ObjectTableType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/object/table")
 */
class ObjectTableController extends AbstractController
{
    /**
     * @Route("/", name="object_table_index", methods={"GET"})
     */
    public function index(): Response
    {
        $objectTables = $this->getDoctrine()
            ->getRepository(ObjectTable::class)
            ->findAll();

        return $this->render('object_table/index.html.twig', [
            'object_tables' => $objectTables,
        ]);
    }

    /**
     * @Route("/new", name="object_table_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $objectTable = new ObjectTable();
        $form = $this->createForm(ObjectTableType::class, $objectTable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objectTable);
            $entityManager->flush();

            return $this->redirectToRoute('object_table_index');
        }

        return $this->render('object_table/new.html.twig', [
            'object_table' => $objectTable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="object_table_show", methods={"GET"})
     */
    public function show(ObjectTable $objectTable): Response
    {
        return $this->render('object_table/show.html.twig', [
            'object_table' => $objectTable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="object_table_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ObjectTable $objectTable): Response
    {
        $form = $this->createForm(ObjectTableType::class, $objectTable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('object_table_index', [
                'id' => $objectTable->getId(),
            ]);
        }

        return $this->render('object_table/edit.html.twig', [
            'object_table' => $objectTable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="object_table_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ObjectTable $objectTable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objectTable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($objectTable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('object_table_index');
    }
}
