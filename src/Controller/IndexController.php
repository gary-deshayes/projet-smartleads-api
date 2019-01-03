<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
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
                     ->add('name')
                     ->add('gender')
                     ->add('company')
                     ->add('company_function')
                     ->add('birth_date', DateType::class)
                     ->add('mobile_phone')
                     ->add('phone')
                     ->getForm();

        $form->handleRequest($request);

        


        return $this->render('site/create.html.twig', [
            'formContact' => $form->createView()
        ]);

    }
}
