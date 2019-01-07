<?php

namespace App\Controller;

use App\Form\CompanyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/company")
*/
class CompanyController extends AbstractController
{

    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="company_editShow", methods={"GET","POST"})
     */
    public function editShow()
    {

    }

    /**
     * Persistance des données
     * @Route("/", name="company_edit", methods={"PUT"})
     */
    public function edit()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/delete/{id}", name="company_deleteShow", methods={"GET","POST"})
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
     * @Route("/create", name="company_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(CompanyType::class);

        

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if($retour == 1){
                return $this->render('company/index.html.twig');
            }else{
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
     * @Route("/", name="company_create", methods={"POST"})
     */
    public function create(Request $request)
    {

        $company = new Company();

        $formCreate = $this->createForm(CompanyType::class, $company);

        $formCreate->handleRequest($request);

        if ($formCreate->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();
        }

    }

    /**
     * Affichage du formulaire
     * @Route("/", name="company_create", methods={"GET"})
     */
    public function show()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="company_success", methods={"POST"})
     */
    public function success()
    {

    }


}
