<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ContactCompanyService;
use App\AdminBundle\Form\ContactCompanyServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/contactCompanyService")
 */
class ContactCompanyServiceController extends AbstractController
{
    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="ContactCompanyService_editShow", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contactCompanyService = $em->getRepository(ContactCompanyService::class)->find($id);

        $form = $this->createForm(ContactCompanyServiceType::class, $contactCompanyService);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($contactCompanyService->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("ContactCompanyService");
            } else {
                return $this->render('contact_company_service/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$contactCompanyService) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('contact_company_service/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }
    /**
     * Affichage du formulaire
     * @Route("delete/{id}", name="ContactCompanyService_deleteShow", methods={"GET","POST"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="ContactCompanyService_createShow", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $formCreate = $this->createForm(ContactCompanyServiceType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('ContactCompanyService');
            } else {
                return $this->render('contact_company_service/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('contact_company_service/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="ContactCompanyService", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(ContactCompanyService::class);
        $contactCompanyService = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($contactCompanyService, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('contact_company_service/index.html.twig', array(
                "ContactCompanyService" => $contactCompanyService
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="contactCompanyService_success", methods={"POST"})
     */
    public function success()
    {

    }
}
