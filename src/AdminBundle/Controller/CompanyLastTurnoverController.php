<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyLastTurnover;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\AdminBundle\Form\CompanyLastTurnoverType;

/**
 * @Route("/companyLastTurnover")
 */
class CompanyLastTurnoverController extends AbstractController
{
    

    /**
     * Affichage du formulaire
     * @Route("/edit/{id}", name="companyLastTurnover_editShow", methods={"GET","POST"})
     */
    public function edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $companyLastTurnover = $em->getRepository(CompanyLastTurnover::class)->find($id);

        $form = $this->createForm(CompanyLastTurnoverType::class, $companyLastTurnover);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($companyLastTurnover->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("companyLastTurnover");
            } else {
                return $this->render('company_last_turnover/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$companyLastTurnover) {
            throw $this->createNotFoundException(
                'No companyActivityArea found for id ' . $id
            );
        }

        return $this->render('company_last_turnover/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }


    /**
     * Affichage du formulaire
     * @Route("delete/{id}", name="companyLastTurnover_deleteShow", methods={"GET","POST"})
     */
    public function delete()
    {

    }

    /**
     * Affichage du formulaire
     * @Route("/create", name="companyLastTurnover_createShow", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $formCreate = $this->createForm(CompanyLastTurnoverType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('companyLastTurnover');
            } else {
                return $this->render('company_last_turnover/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('company_last_turnover/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Affichage de la liste des derniers CA
     * @Route("/", name="companyLastTurnover", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(CompanyLastTurnover::class);
        $companyLastTurnover = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($companyLastTurnover, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('company_last_turnover/index.html.twig', array(
                "companyLastTurnover" => $companyLastTurnover
            ));
        }
    }

    /**
     * Affichage du formulaire
     * @Route("/success", name="companyLastTurnover_success", methods={"POST"})
     */
    public function success()
    {

    }
}
