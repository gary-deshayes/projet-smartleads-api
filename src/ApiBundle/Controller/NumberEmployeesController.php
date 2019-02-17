<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\NumberEmployees;
use App\AdminBundle\Form\NumberEmployeesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/numberemployees")
 */
class NumberEmployeesController extends AbstractController
{
    /**
     * Récupération des nombres d'employées
     * @Route("/get/{id}", name="api_numberemployees_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un nombre d'employée
     * @Route("/post", name="api_numberemployees_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un nombre d'employée
     * @Route("/edit/{id}", name="api_numberemployees_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un nombre d'employée
     * @Route("/delete/{id}", name="api_numberemployees_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
