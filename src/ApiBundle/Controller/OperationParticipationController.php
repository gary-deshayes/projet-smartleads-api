<?php

namespace App\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operationParticipation")
 */
class OperationParticipationController extends AbstractController
{
    /**
     * @Route("/operation/participation", name="operation_participation")
     */
    public function index()
    {
        return $this->render('operation_participation/index.html.twig', [
            'controller_name' => 'OperationParticipationController',
        ]);
    }
}
