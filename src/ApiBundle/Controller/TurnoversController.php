<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Turnovers;
use App\AdminBundle\Form\TurnoversType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/turnovers")
 */
class TurnoversController extends AbstractController
{
    /**
     * Récupération des chiffres d'affaires
     * @Route("/get/{id}", name="api_turnovers_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un chiffre d'affaire
     * @Route("/post", name="api_turnovers_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un chiffre d'affaire
     * @Route("/edit/{id}", name="api_turnovers_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un chiffre d'affaire
     * @Route("/delete/{id}", name="api_turnovers_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
