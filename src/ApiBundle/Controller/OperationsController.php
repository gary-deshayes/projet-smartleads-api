<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Form\OperationsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operations")
 */
class OperationsController extends AbstractController
{
    /**
     * Récupération des opérations
     * @Route("/get/{id}", name="api_operations_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'une opération
     * @Route("/post", name="api_operations_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'une opération
     * @Route("/edit/{id}", name="api_operations_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'une opération
     * @Route("/delete/{id}", name="api_operations_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
