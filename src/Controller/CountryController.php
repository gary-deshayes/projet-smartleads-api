<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    /**
     * @Route("/country", name="country")
     */
    public function index()
    {
        return $this->render('country/index.html.twig', [
            'controller_name' => 'CountryController',
        ]);
    }
}
