<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\LegalStatus;
use App\AdminBundle\Form\LegalStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/legalstatus")
 */
class LegalStatusController extends AbstractController
{
    /**
     * Récupération des statut légaux
     * @Route("/get/{id}", name="api_legalstatus_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un statut légal
     * @Route("/post", name="api_legalstatus_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un statut légal
     * @Route("/edit/{id}", name="api_legalstatus_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un statut légal
     * @Route("/delete/{id}", name="api_legalstatus_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
