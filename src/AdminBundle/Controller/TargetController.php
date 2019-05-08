<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Target;
use App\AdminBundle\Form\TargetType;
use App\AdminBundle\Entity\NumberEmployees;
use App\AdminBundle\Entity\TargetOperation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/target_operation")
 */
class TargetController extends AbstractController
{
    /**
     * @Route("/", name="target_index", methods={"GET"})
     */
    public function index(): Response
    {
        $targets = $this->getDoctrine()
            ->getRepository(Target::class)
            ->findAll();

        return $this->render('target/index.html.twig', [
            'targets' => $targets,
        ]);
    }

    /**
     * @Route("/new", name="target_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $target = new TargetOperation();
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($target);
            $entityManager->flush();

            return $this->redirectToRoute('target_index');
        }

        return $this->render('target/new.html.twig', [
            'target' => $target,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="target_show", methods={"GET"})
     */
    public function show(TargetOperation $target): Response
    {
        return $this->render('target/show.html.twig', [
            'target' => $target,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="target_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TargetOperation $target): Response
    {
        $form = $this->createForm(TargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('target_index', [
                'id' => $target->getId(),
            ]);
        }

        return $this->render('target/edit.html.twig', [
            'target' => $target,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="target_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TargetOperation $target): Response
    {
        if ($this->isCsrfTokenValid('delete' . $target->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($target);
            $entityManager->flush();
        }

        return $this->redirectToRoute('target_index');
    }

    /**
     * @Route("/selectDynamique/{entity}", name="target_operation_select_dynamique", methods={"GET"})
     */
    public function selectDynamique($entity)
    {
        $result = $this->getDoctrine()->getRepository("AdminBundle:" . $entity)->findBy(array(), array("libelle" => "ASC"));

        $data = array();
        if ($entity == "Country") {
            foreach ($result as $res) {
                $jsonData = array(
                    "code" => $res->getCode(),
                    "libelle" => $res->getLibelle()
                );



                array_push($data, $jsonData);
            }
        } else {
            foreach ($result as $res) {
                $jsonData = array(
                    "id" => $res->getId(),
                    "libelle" => $res->getLibelle()
                );



                array_push($data, $jsonData);
            }
        }


        $dataJson = [
            "entité" => $entity,
            "data" => $data,
            "retour" => "-1"
        ];
        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/envoi_operation",name="target_operation_envoi")
     */
    public function envoiOperation(Request $request)
    { 
        dump($request);

        return new Response("toto");
    
    }

}
