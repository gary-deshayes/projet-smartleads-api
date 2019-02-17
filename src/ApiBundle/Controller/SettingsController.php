<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Settings;
use App\AdminBundle\Form\SettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/settings")
 */
class SettingsController extends AbstractController
{
    /**
     * Récupération des paramètres
     * @Route("/get/{id}", name="api_settings_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un paramètre
     * @Route("/post", name="api_settings_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un paramètre
     * @Route("/edit/{id}", name="api_settings_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un paramètre
     * @Route("/delete/{id}", name="api_settings_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
