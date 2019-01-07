<?php

namespace App\Controller;

use App\Entity\CompanyLegalStatus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\CompanyLegalStatusType;

/**
 * @Route("companyLegalStatus")
 */
class CompanyLegalStatusController extends AbstractController
{
    

    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="companyLegalStatus_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $CompanyLegalStatus = $em->getRepository(CompanyLegalStatus::class)->find($id);

        $form = $this->createForm(CompanyLegalStatusType::class, $CompanyLegalStatus);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($CompanyLegalStatus->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("companyLegalStatus");
            } else {
                return $this->render('company_legal_status/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$CompanyLegalStatus) {
            throw $this->createNotFoundException(
                'No company legal status found for id ' . $id
            );
        }

        return $this->render('company_legal_status/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="companyLegalStatus_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $CompanyLegalStatus = $em->getRepository(CompanyLegalStatus::class)->find($id);

        $form = $this->createForm(CompanyLegalStatusType::class, $CompanyLegalStatus);

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
     * @Route("delete/{id}", name="companyLegalStatus_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression du statut legal
     * @Route("/", name="companyLegalStatus_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="companyLegalStatus_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(CompanyLegalStatusType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('companyLegalStatus');
            } else {
                return $this->render('company_legal_status/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('company_legal_status/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="companyLegalStatus_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

        $CompanyLegalStatus = new CompanyLegalStatus();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(CompanyLegalStatusType::class, $CompanyLegalStatus);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($CompanyLegalStatus);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }

    /**
     * Affichage de la liste des statuts legaux
     * @Route("/", name="companyLegalStatus", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(CompanyLegalStatus::class);
        $CompanyLegalStatus = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($CompanyLegalStatus, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('company_legal_status/index.html.twig', array(
                "companyLegalStatus" => $CompanyLegalStatus
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="companyLegalStatus_success", methods={"POST"})
     */
    public function success()
    {

    }
}
