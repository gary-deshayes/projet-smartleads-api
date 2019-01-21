<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactJobController extends AbstractController
{
    /**
     * @Route("/contact/job", name="contact_job")
     */
    public function index()
    {
        return $this->render('contact_job/index.html.twig', [
            'controller_name' => 'ContactJobController',
        ]);
    }
}
