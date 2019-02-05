<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ContactCompanyFunction;
use App\AdminBundle\Form\ContactCompanyFunctionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/contactCompanyFunction")
 */
class ContactCompanyFunctionController extends AbstractController
{
     /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="ContactCompanyFunction_editShow", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contactCompanyFunction = $em->getRepository(ContactCompanyFunction::class)->find($id);

        $form = $this->createForm(ContactCompanyFunctionType::class, $contactCompanyFunction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($contactCompanyFunction->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("ContactCompanyFunction");
            } else {
                return $this->render('contact_company_function/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$contactCompanyFunction) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('contact_company_function/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Affichage du formulaire
     * @Route("delete/{id}", name="ContactCompanyFunction_deleteShow", methods={"GET","POST"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="ContactCompanyFunction_createShow", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $formCreate = $this->createForm(ContactCompanyFunctionType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('ContactCompanyFunction');
            } else {
                return $this->render('contact_company_function/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('contact_company_function/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="ContactCompanyFunction", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(ContactCompanyFunction::class);
        $contactCompanyFunction = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($contactCompanyFunction, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('contact_company_function/index.html.twig', array(
                "ContactCompanyFunction" => $contactCompanyFunction
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="contactCompanyFunction_success", methods={"POST"})
     */
    public function success()
    {

    }
}
