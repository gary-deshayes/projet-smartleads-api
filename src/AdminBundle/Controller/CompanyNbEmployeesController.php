<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyNbEmployees;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\AdminBundle\Form\CompanyNbEmployeesType;

/**
 * @Route("/companyNbEmployees")
 */
class CompanyNbEmployeesController extends AbstractController
{
    

    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="companyNbEmployees_editShow", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $companyNbEmployee = $em->getRepository(CompanyNbEmployees::class)->find($id);

        $form = $this->createForm(CompanyNbEmployeesType::class, $companyNbEmployee);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($companyNbEmployee->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("companyNbEmployees");
            } else {
                return $this->render('company_nb_employees/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$companyNbEmployee) {
            throw $this->createNotFoundException(
                'No companyNbEmployee found for id ' . $id
            );
        }

        return $this->render('company_nb_employees/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Affichage du formulaire
     * @Route("delete/{id}", name="companyNbEmployees_deleteShow", methods={"GET","POST"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="companyNbEmployees_createShow", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $formCreate = $this->createForm(CompanyNbEmployeesType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('companyNbEmployees');
            } else {
                return $this->render('company_nb_employees/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('company_nb_employees/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage de la liste de nombre d'employées
     * @Route("/", name="companyNbEmployees", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(CompanyNbEmployees::class);
        $companyNbEmployee = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($companyNbEmployee, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('company_nb_employees/index.html.twig', array(
                "companyNbEmployee" => $companyNbEmployee
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="companyNbEmployees_success", methods={"POST"})
     */
    public function success()
    {

    }
}
