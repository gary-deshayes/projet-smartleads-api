<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\Company;
use App\ApiBundle\Form\CompanyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("api/company")
*/
class CompanyController extends AbstractController
{

   /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="Company_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository(Company::class)->find($id);

        $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($company->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("Company");
            } else {
                return $this->render('company/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$company) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('company/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="Company_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository(Company::class)->find($id);

        $form = $this->createForm(CompanyType::class, $company);

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
     * @Route("delete/{id}", name="company_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression de l'entreprise
     * @Route("/", name="company_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="Company_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(CompanyType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('Company');
            } else {
                return $this->render('company/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('company/create.html.twig', [
            'form' => $formCreate->createView(),			
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="Company_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

        $company = new Company();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyType::class, $company);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }

    /**
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="Company", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(Company::class);
        $company = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($company, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('company/index.html.twig', array(
                "Company" => $company
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="company_success", methods={"POST"})
     */
    public function success()
    {

    }
}
