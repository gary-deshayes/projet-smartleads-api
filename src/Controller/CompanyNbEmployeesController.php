<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CompanyNbEmployeesController extends AbstractController
{
    /**
     * @Route("/company/nb/employees", name="company_nb_employees")
     */
    public function index()
    {
        return $this->render('company_nb_employees/index.html.twig', [
            'controller_name' => 'CompanyNbEmployeesController',
        ]);
    }
}
