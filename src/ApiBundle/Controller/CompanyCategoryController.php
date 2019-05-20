<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\CompanyCategory;
use App\AdminBundle\Form\CompanyCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/companycategory")
 */
class CompanyCategoryController extends AbstractController
{
    /**
     * Récupération des catégories d'entreprises
     * @Route("/get/{id}", name="api_companycategory_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'une catégorie d'entreprise
     * @Route("/post", name="api_companycategory_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'une catégorie d'entreprise
     * @Route("/edit/{id}", name="api_companycategory_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'une catégorie d'entreprise
     * @Route("/delete/{id}", name="api_companycategory_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
