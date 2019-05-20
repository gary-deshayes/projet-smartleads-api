<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Target;
use App\AdminBundle\Form\TargetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/target")
 */
class TargetController extends AbstractController
{
     /**
     * Récupération des cibles
     * @Route("/get/{id}", name="api_target_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'une cible
     * @Route("/post", name="api_target_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'une cible
     * @Route("/edit/{id}", name="api_target_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'une cible
     * @Route("/delete/{id}", name="api_target_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
