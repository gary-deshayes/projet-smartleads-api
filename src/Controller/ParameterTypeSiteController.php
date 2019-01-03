<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ParameterTypeSiteController extends AbstractController
{
    /**
     * @Route("/parameter/type/site", name="parameter_type_site")
     */
    public function index()
    {
        return $this->render('parameter_type_site/index.html.twig', [
            'controller_name' => 'ParameterTypeSiteController',
        ]);
    }
}
