<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\CompanyCategory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\ApiBundle\Form\CompanyCategoryType;

/**
 * @Route("api/companyCategory")
 */
class CompanyCategoryController extends AbstractController
{
    

    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="companyCategory_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $companyCategory = $em->getRepository(CompanyCategory::class)->find($id);

        $form = $this->createForm(CompanyCategoryType::class, $companyCategory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($companyCategory->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("companyCategory");
            } else {
                return $this->render('company_category/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$companyCategory) {
            throw $this->createNotFoundException(
                'No companyActivityArea found for id ' . $id
            );
        }

        return $this->render('company_category/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="companyCategory_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $companyCategory = $em->getRepository(CompanyCategory::class)->find($id);

        $form = $this->createForm(CompanyCategoryType::class, $companyCategory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");
        return $response;

    }

    /**
     * Affichage du formulaire
     * @Route("delete/{id}", name="companyCategory_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression du secteur
     * @Route("/", name="companyCategory_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="companyCategory_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(CompanyCategoryType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('companyCategory');
            } else {
                return $this->render('company_category/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('company_category/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="companyCategory_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

        $companyCategory = new CompanyCategory();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyCategoryType::class, $companyCategory);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($companyCategory);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }

    /**
     * Affichage de la liste des catégories d'entreprises
     * @Route("/", name="companyCategory", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(CompanyCategory::class);
        $companyCategory = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($companyCategory, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('company_category/index.html.twig', array(
                "companyCategory" => $companyCategory
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="companyCategory_success", methods={"POST"})
     */
    public function success()
    {

    }
}
