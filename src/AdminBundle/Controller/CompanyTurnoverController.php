<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyTurnover;
use App\AdminBundle\Form\CompanyTurnoverType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/companyTurnover")
 */
class CompanyTurnoverController extends AbstractController
{
    

    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="companyTurnover_editShow", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $CompanyTurnover = $em->getRepository(CompanyTurnover::class)->find($id);

        $form = $this->createForm(CompanyTurnoverType::class, $CompanyTurnover);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($CompanyTurnover->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("companyTurnover");
            } else {
                return $this->render('company_turnover/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$CompanyTurnover) {
            throw $this->createNotFoundException(
                'No CompanyTurnover found for id ' . $id
            );
        }

        return $this->render('company_turnover/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Affichage du formulaire
     * @Route("delete/{id}", name="companyTurnover_deleteShow", methods={"GET","POST"})
     */
    public function delete()
    {

    }
    /**
     * Affichage du formulaire
     * @Route("/create", name="companyTurnover_createShow", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $formCreate = $this->createForm(CompanyTurnoverType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('companyTurnover');
            } else {
                return $this->render('company_turnover/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('company_turnover/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }


    /**
     * Affichage de la liste de nombre d'employées
     * @Route("/", name="companyTurnover", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(CompanyTurnover::class);
        $CompanyTurnover = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($CompanyTurnover, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('company_turnover/index.html.twig', array(
                "companyTurnover" => $CompanyTurnover
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="companyTurnover_success", methods={"POST"})
     */
    public function success()
    {

    }
}
