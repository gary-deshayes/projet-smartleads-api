<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompanyLegalStatusController extends AbstractController
{
    /**
     * @Route("/company/legal/status", name="company_legal_status")
     */
    public function index()
    {
        return $this->render('company_legal_status/index.html.twig', [
            'controller_name' => 'CompanyLegalStatusController',
        ]);
    }
}
