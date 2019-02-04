<?php

namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\Gender;
use App\ApiBundle\Form\GenderType;
use App\ApiBundle\Repository\GenderRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("api/Gender")
 */
class GenderController extends AbstractController
{
    /**
     * Edit des données
     * @Route("/edit/{id}", name="Gender_edit", methods={"PUT"})
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
     * Suppression de l'entreprise
     * @Route("delete/{id}", name="ParameterTypeSite_delete", methods={"DELETE"})
     */
    public function delete()
    {

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
     * @Route("/{id}", name="Gender", methods={"GET"})
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
}
