<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Country;
use App\AdminBundle\Form\CountryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/country")
 */
class CountryController extends AbstractController
{
   /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="Country_editShow", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coutry = $em->getRepository(Country::class)->find($id);

        $form = $this->createForm(CountryType::class, $coutry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($coutry->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("Country");
            } else {
                return $this->render('country/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$country) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('country/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Affichage du formulaire
     * @Route("delete/{id}", name="Country_deleteShow", methods={"GET","POST"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="Country_createShow", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $formCreate = $this->createForm(CountryType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('Country');
            } else {
                return $this->render('country/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('country/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage de la liste des paramètres de type de site
     * @Route("/", name="Country", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(Country::class);
        $country = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($country, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('country/index.html.twig', array(
                "Country" => $country
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
