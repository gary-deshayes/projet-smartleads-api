<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompanyLastTurnoverController extends AbstractController
{
    /**
     * @Route("/company/last/turnover", name="company_last_turnover")
     */
    public function index()
    {
        return $this->render('company_last_turnover/index.html.twig', [
            'controller_name' => 'CompanyLastTurnoverController',
        ]);
    }
}
