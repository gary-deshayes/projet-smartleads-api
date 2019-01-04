<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParameterComportmentController extends AbstractController
{
    /**
     * @Route("/parameter/comportment", name="parameter_comportment")
     */
    public function index()
    {
        return $this->render('parameter_comportment/index.html.twig', [
            'controller_name' => 'ParameterComportmentController',
        ]);
    }
}
