<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyActivityArea;
use App\AdminBundle\Form\CompanyActivityAreaType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Repository\ParameterTargetRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("companyActivityArea")
 */
class CompanyActivityAreaController extends AbstractController
{
    

    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="companyActivityArea_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $companyActivityArea = $em->getRepository(CompanyActivityArea::class)->find($id);

        $form = $this->createForm(CompanyActivityAreaType::class, $companyActivityArea);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($companyActivityArea->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("companyActivityArea");
            } else {
                return $this->render('company_activity_area/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$companyActivityArea) {
            throw $this->createNotFoundException(
                'No companyActivityArea found for id ' . $id
            );
        }

        return $this->render('company_activity_area/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="companyActivityArea_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $companyActivityArea = $em->getRepository(CompanyActivityArea::class)->find($id);

        $form = $this->createForm(CompanyActivityAreaType::class, $companyActivityArea);

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
     * @Route("delete/{id}", name="companyActivityArea_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression du secteur
     * @Route("/", name="companyActivityArea_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="companyActivityArea_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(CompanyActivityAreaType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('companyActivityArea');
            } else {
                return $this->render('company_activity_area/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('company_activity_area/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="companyActivityArea_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

        $companyActivityArea = new CompanyActivityArea();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyActivityAreaType::class, $companyActivityArea);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($companyActivityArea);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }

    /**
     * Affichage de la liste des secteurs d'activités
     * @Route("/", name="companyActivityArea", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(CompanyActivityArea::class);
        $companyActivityArea = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($companyActivityArea, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('company_activity_area/index.html.twig', array(
                "CompanyActivityArea" => $companyActivityArea
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="companyActivityArea_success", methods={"POST"})
     */
    public function success()
    {

    }
}
