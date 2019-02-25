<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Salesperson;
use App\AdminBundle\Form\SalespersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salesperson")
 */
class SalespersonController extends AbstractController
{
    /**
     * Récupération des commerciaux
     * @Route("/get/{id}", name="api_salesperson_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un commercial
     * @Route("/post", name="api_salesperson_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un commercial
     * @Route("/edit/{id}", name="api_salesperson_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un commercial
     * @Route("/delete/{id}", name="api_salesperson_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
