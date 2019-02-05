<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyCategory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\AdminBundle\Form\CompanyCategoryType;

/**
 * @Route("/companyCategory")
 */
class CompanyCategoryController extends AbstractController
{
    

    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="companyCategory_editShow", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
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
     * Affichage du formulaire
     * @Route("delete/{id}", name="companyCategory_deleteShow", methods={"GET","POST"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="companyCategory_createShow", methods={"GET","POST"})
     */
    public function create(Request $request)
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
