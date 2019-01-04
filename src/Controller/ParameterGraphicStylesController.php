<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParameterGraphicStylesController extends AbstractController
{
    /**
     * @Route("/parameter/graphic/styles", name="parameter_graphic_styles")
     */
    public function index()
    {
        return $this->render('parameter_graphic_styles/index.html.twig', [
            'controller_name' => 'ParameterGraphicStylesController',
        ]);
    }
}
