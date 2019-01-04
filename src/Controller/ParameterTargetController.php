<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParameterTargetController extends AbstractController
{
    /**
     * @Route("/parameter/target", name="parameter_target")
     */
    public function index()
    {
        return $this->render('parameter_target/index.html.twig', [
            'controller_name' => 'ParameterTargetController',
        ]);
    }
}
