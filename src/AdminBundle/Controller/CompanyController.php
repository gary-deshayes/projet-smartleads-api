<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Form\CompanyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/company")
*/
class CompanyController extends AbstractController
{

   /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="Company_editShow", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
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
     * Affichage du formulaire
     * @Route("delete/{id}", name="company_deleteShow", methods={"GET","POST"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="Company_createShow", methods={"GET","POST"})
     */
    public function create(Request $request)
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
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="company", methods={"GET"})
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
