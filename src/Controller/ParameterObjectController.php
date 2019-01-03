<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParameterObjectController extends AbstractController
{
    /**
     * @Route("/parameter/object", name="parameter_object")
     */
    public function index()
    {
        return $this->render('parameter_object/index.html.twig', [
            'controller_name' => 'ParameterObjectController',
        ]);
    }
}
