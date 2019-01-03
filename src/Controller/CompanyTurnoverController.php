<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompanyTurnoverController extends AbstractController
{
    /**
     * @Route("/company/turnover", name="company_turnover")
     */
    public function index()
    {
        return $this->render('company_turnover/index.html.twig', [
            'controller_name' => 'CompanyTurnoverController',
        ]);
    }
}
