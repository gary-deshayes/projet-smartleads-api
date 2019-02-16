<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\ActivityArea;
use App\AdminBundle\Form\ActivityAreaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activity/area")
 */
class ActivityAreaController extends AbstractController
{
    /**
     * Récupération des aires d'activités
     * @Route("/get/{id}", name="api_activityarea_get", methods={"GET"})
     */
    public function get(){
    }
    /**
     * Création d'une aire d'activité
     * @Route("/post", name="api_activityarea_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'une aire d'activité
     * @Route("/edit/{id}", name="api_activityarea_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'une aire d'activité
     * @Route("/delete/{id}", name="api_activityarea_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
