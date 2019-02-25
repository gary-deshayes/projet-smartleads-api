<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Profession;
use App\AdminBundle\Form\ProfessionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profession")
 */
class ProfessionController extends AbstractController
{
    /**
     * Récupération des métiers
     * @Route("/get/{id}", name="api_profession_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un métier
     * @Route("/post", name="api_profession_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un métier
     * @Route("/edit/{id}", name="api_profession_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un métier
     * @Route("/delete/{id}", name="api_profession_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
