<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyCategory;
use App\AdminBundle\Form\CompanyCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company/category")
 */
class CompanyCategoryController extends AbstractController
{
    /**
     * @Route("/", name="company_category_index", methods={"GET"})
     */
    public function index(): Response
    {
        $companyCategories = $this->getDoctrine()
            ->getRepository(CompanyCategory::class)
            ->findAll();

        return $this->render('company_category/index.html.twig', [
            'company_categories' => $companyCategories,
        ]);
    }

    /**
     * @Route("/new", name="company_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $companyCategory = new CompanyCategory();
        $form = $this->createForm(CompanyCategoryType::class, $companyCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($companyCategory);
            $entityManager->flush();

            return $this->redirectToRoute('company_category_index');
        }

        return $this->render('company_category/new.html.twig', [
            'company_category' => $companyCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_category_show", methods={"GET"})
     */
    public function show(CompanyCategory $companyCategory): Response
    {
        return $this->render('company_category/show.html.twig', [
            'company_category' => $companyCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="company_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CompanyCategory $companyCategory): Response
    {
        $form = $this->createForm(CompanyCategoryType::class, $companyCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('company_category_index', [
                'id' => $companyCategory->getId(),
            ]);
        }

        return $this->render('company_category/edit.html.twig', [
            'company_category' => $companyCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CompanyCategory $companyCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$companyCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($companyCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('company_category_index');
    }
}
