<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/user", name="user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user", methods={"GET"})
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
     * @Route("/edit/{id}", name="user_edit_show", methods={"GET", "POST"})
     */
    public function editShow()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/", name="user_edit", methods={"PUT"})
     */
    public function edit()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="user_delete_show", methods={"GET", "POST"})
     */
    public function deleteShow()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/", name="user_delete", methods={"DELETE"})
     */
    public function delete()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/create", name="user_create_show", methods={"GET", "POST"})
     */
    public function createShow(Request $request)
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
     * @Route("/", name="user_create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer)
    {
        $user = new User();
        $response = new Response();

        $json = $serializer->serialize(
            $user,
            'json',
            ['Groups'=>["Light"]]
        );

        $formCreate = $this->createForm(UserType::class);
        $formCreate->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $response->setContent($json);
        $response->headers->set('Content-Type', 'application/JSON');
        return $response;
    }

    /**
     * @Route("/", name="user", methods={"GET"})
     */
    public function show()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/success", name="user_success", methods={"GET"})
     */
    public function success()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
