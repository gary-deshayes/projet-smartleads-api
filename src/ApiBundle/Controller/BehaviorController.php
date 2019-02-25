<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Behavior;
use App\AdminBundle\Form\BehaviorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/behavior")
 */
class BehaviorController extends AbstractController
{
    /**
     * Récupération des comportements
     * @Route("/get/{id}", name="api_behavior_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un comportement
     * @Route("/post", name="api_behavior_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un comportement
     * @Route("/edit/{id}", name="api_behavior_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un comportement
     * @Route("/delete/{id}", name="api_behavior_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
