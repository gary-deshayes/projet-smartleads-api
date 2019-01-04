<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OperationTypeController extends AbstractController
{
    /**
     * @Route("/operation/type", name="operation_type")
     */
    public function index()
    {
        return $this->render('operation_type/index.html.twig', [
            'controller_name' => 'OperationTypeController',
        ]);
    }
}
