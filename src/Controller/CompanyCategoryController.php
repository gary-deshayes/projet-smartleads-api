<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompanyCategoryController extends AbstractController
{
    /**
     * @Route("/company/category", name="company_category")
     */
    public function index()
    {
        return $this->render('company_category/index.html.twig', [
            'controller_name' => 'CompanyCategoryController',
        ]);
    }
}
