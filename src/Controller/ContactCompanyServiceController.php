<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactCompanyServiceController extends AbstractController
{
    /**
     * @Route("/contact/company/service", name="contact_company_service")
     */
    public function index()
    {
        return $this->render('contact_company_service/index.html.twig', [
            'controller_name' => 'ContactCompanyServiceController',
        ]);
    }
}
