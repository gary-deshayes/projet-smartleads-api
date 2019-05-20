<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\OperationSent;
use App\AdminBundle\Form\OperationSentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operationsent")
 */
class OperationSentController extends AbstractController
{
    /**
     * Récupération des opérations envoyées
     * @Route("/get/{id}", name="api_operationsent_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'une opération envoyée
     * @Route("/post", name="api_operationsent_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'une opération envoyée
     * @Route("/edit/{id}", name="api_operationsent_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'une opération envoyée
     * @Route("/delete/{id}", name="api_operationsent_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
