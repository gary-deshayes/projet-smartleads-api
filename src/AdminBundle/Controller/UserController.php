<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\User;
use App\AdminBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * Récupération de la liste des utilisateurs et affichage sur twig
     * @Route("", name="user", methods={"GET"})
     */
    public function index(Request $request, SerializerInterface $serializer)
    {

        $response = new Response();

        $repo = $this->getDoctrine()->getRepository(User::class);
        $User = $repo->findAll();

        if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize($User, "json", ["GROUPS" => ["Light"]]);
            $response->setContent($json);
            return $response;
        } else {
            return $this->render('user/index.html.twig', array(
                "User" => $User
            ));
        }
    }

    /**
     * Edition d'un utilisateur par twig
     * @Route("/edit/{id}", name="user_edit", methods={"GET", "POST"})
     */
    public function edit()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * Permet de supprimer un utilisateur par twig
     * @Route("/delete/{id}", name="user_delete", methods={"GET"})
     */
    public function delete()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * Création d'un nouvel utilisateur par twig
     * @Route("/new", name="user_new", methods={"GET", "POST"})
     */
    public function new(Request $request)
    {
        $formCreate = $this->createForm(UserType::class);

        if($formCreate->isSubmitted() && $formCreate->isValid()) {
            $this->create($request);
        }

        return $this->render('user/create.html.twig', [
            'form' => $formCreate->createView(),
        ]);
    }

    /**
     * Route qui retourne un message en cas de succès d'une requête
     * @Route("/success", name="user_success", methods={"GET"})
     */
    public function success()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
