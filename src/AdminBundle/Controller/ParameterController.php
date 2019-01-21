<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParameterController extends AbstractController
{
    /**
     * @Route("/parameter", name="parameter")
     */
    public function index()
    {
        return $this->render('parameter/index.html.twig', [
            'controller_name' => 'ParameterController',
        ]);
    }
}
