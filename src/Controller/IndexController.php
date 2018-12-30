<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="home")
     */
    public function index()
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/site/new", name="site_create")
     */
    public function create(Request $request, ObjectManager $manager){

        $contact = new Contact();

        $form = $this->createFormBuilder($contact)
                     ->add('code_customer')
                     ->add('first_name')
                     ->add('mobile_phone')
                     ->getForm();

        return $this->render('site/create.html.twig', [
            'formContact' => $form->createView()
        ]);
    }
}
