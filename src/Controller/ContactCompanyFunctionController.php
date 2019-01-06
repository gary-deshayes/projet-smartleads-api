<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactCompanyFunctionController extends AbstractController
{
    /**
     * @Route("/contact/company/function", name="contact_company_function")
     */
    public function index()
    {
        return $this->render('contact_company_function/index.html.twig', [
            'controller_name' => 'ContactCompanyFunctionController',
        ]);
    }
}
