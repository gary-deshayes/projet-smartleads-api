<?php

namespace App\Controller;

use App\Entity\Gender;
use App\Form\GenderType;
use App\Repository\GenderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/Gender")
 */
class GenderController extends AbstractController
{
    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="Gender_editShow", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $gender = $em->getRepository(Gender::class)->find($id);

        $form = $this->createForm(GenderType::class, $gender);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($gender->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("Gender");
            } else {
                return $this->render('gender/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$gender) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('gender/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit des données
     * @Route("/{id}", name="Gender_edit", methods={"PUT"})
     */
    public function edit($id, $request)
    {

        $response = new Response();

        $em = $this->getDoctrine()->getManager();

        $gender = $em->getRepository(Gender::class)->find($id);

        $form = $this->createForm(GenderType::class, $gender);

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
     * @Route("delete/{id}", name="ParameterTypeSite_deleteShow", methods={"GET","POST"})
     */
    public function deleteShow()
    {

    }

    /**
     * Suppression de l'entreprise
     * @Route("/", name="ParameterTypeSite_delete", methods={"DELETE"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="Gender_createShow", methods={"GET","POST"})
     */
    public function createShow(Request $request)
    {
        $formCreate = $this->createForm(GenderType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('Gender');
            } else {
                return $this->render('gender/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('gender/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage du formulaire
     * @Route("/", name="Gender", methods={"POST"})
     * 
     */
    public function create(Request $request)
    {

        $gender = new Gender();

        $response = new Response();

        $response->headers->set("Content-Type", "Application/JSON");

        $formCreate = $this->createForm(GenderType::class, $gender);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($gender);
            $em->flush();
            $response->setContent("1");
            return $response;
        }

        $response->setContent("0");

        return $response;

    }

    /**
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="Gender", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(Gender::class);
        $gender = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($gender, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('gender/index.html.twig', array(
                "Gender" => $gender
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="ParameterTypeSite_success", methods={"POST"})
     */
    public function success()
    {

    }
}
