<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\GraphicStyle;
use App\AdminBundle\Form\GraphicStyleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/graphicstyle")
 */
class GraphicStyleController extends AbstractController
{
    /**
     * Récupération des styles graphiques
     * @Route("/get/{id}", name="api_graphicstyle_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un style graphique
     * @Route("/post", name="api_graphicstyle_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un style graphique
     * @Route("/edit/{id}", name="api_graphicstyle_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un style graphique
     * @Route("/delete/{id}", name="api_graphicstyle_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
