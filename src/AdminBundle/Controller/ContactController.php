<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/Contact")
 */
class ContactController extends AbstractController
{
    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="Contact_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository(Contact::class)->find($id);

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($contact->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("Contact");
            } else {
                return $this->render('contact/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$contact) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('contact/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="Contact_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository(Contact::class)->find($id);

        $form = $this->createForm(ContactType::class, $contact);

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
     * @Route("delete/{id}", name="Contact_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression de l'entreprise
     * @Route("/", name="Contact_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="Contact_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(ContactType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('Contact');
            } else {
                return $this->render('contact/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('contact/create.html.twig', [
            'form' => $formCreate->createView(),			
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="Contact_create", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

        $contact = new Contact();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(ContactType::class, $contact);

        $formCreate->handleRequest($request);

        dump($contact);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }

    /**
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="Contact", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(Contact::class);
        $contact = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($contact, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('contact/index.html.twig', array(
                "Contact" => $contact
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="contact_success", methods={"POST"})
     */
    public function success()
    {

    }
}
