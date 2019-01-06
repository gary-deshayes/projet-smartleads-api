<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GenderController extends AbstractController
{
    /**
     * @Route("/gender", name="gender")
     */
    public function index()
    {
        return $this->render('gender/index.html.twig', [
            'controller_name' => 'GenderController',
        ]);
    }
}
