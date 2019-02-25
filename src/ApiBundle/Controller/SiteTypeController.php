<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\SiteType;
use App\AdminBundle\Form\SiteTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sitetype")
 */
class SiteTypeController extends AbstractController
{
    /**
     * Récupération des types de site
     * @Route("/get/{id}", name="api_sitetype_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un type de site
     * @Route("/post", name="api_sitetype_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un type de site
     * @Route("/edit/{id}", name="api_sitetype_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un type de site
     * @Route("/delete/{id}", name="api_sitetype_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
