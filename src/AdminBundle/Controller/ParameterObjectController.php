<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ParameterObject;
use App\AdminBundle\Form\ParameterObjectType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Repository\ParameterObjectRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/parameterObject")
 */
class ParameterObjectController extends AbstractController
{


    /**
     * Edition d'un paramètre objet par twig
     * @Route("/edit/{id}", name="ParameterObject_edit", methods={"GET","POST"})
     */
    public function editShow($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ParameterObject = $em->getRepository(ParameterObject::class)->find($id);

        $form = $this->createForm(ParameterObjectType::class, $ParameterObject);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $retour = $this->edit($ParameterObject->getId(), $request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute("ParameterObject");
            } else {
                return $this->render('parameter_object/create.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        if (!$ParameterObject) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $this->render('parameter_object/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Suppression d'un paramètre objet par twig
     * @Route("delete/{id}", name="ParameterObject_delete", methods={"GET"})
     */
    public function delete()
    {

    }


    /**
     * Création d'un paramètre objet par twig
     * @Route("/new", name="ParameterObject_new", methods={"GET","POST"})
     */
    public function new(Request $request)
    {
        $formCreate = $this->createForm(ParameterObjectType::class);

        $formCreate->handleRequest($request);

        if ($formCreate->isSubmitted() && $formCreate->isValid()) {

            $retour = $this->create($request);

            if ($retour->getContent() == 1) {
                return $this->redirectToRoute('ParameterObject');
            } else {
                return $this->render('parameter_object/create.html.twig', [
                    'form' => $formCreate->createView(),
                ]);
            }
        }

        return $this->render('parameter_object/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }


    /**
     * Affichage des paramètres objet par twig
     * @Route("/", name="ParameterObject_index", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(ParameterObject::class);
        $ParameterObject = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($ParameterObject, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('parameter_object/index.html.twig', array(
                "ParameterObject" => $ParameterObject
            ));
        }
    }

    /**
     * Affichage d'un message en cas de succès d'une requête
     * @Route("/success", name="ParameterObject_success", methods={"GET"})
     */
    public function success()
    {

    }
}
