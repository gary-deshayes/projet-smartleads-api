<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompanyActivityAreaController extends AbstractController
{
    /**
     * @Route("/company/activity/area", name="company_activity_area")
     */
    public function index()
    {
        return $this->render('company_activity_area/index.html.twig', [
            'controller_name' => 'CompanyActivityAreaController',
        ]);
    }
}
