<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{
    /**
     * Récupération des entreprises actives de type client
     * @Route("/getactivecompanies", name="api_company_getactiveclient", methods={"GET"})
     */
    public function getActifClient(){
        $companies = $this->getDoctrine()
                           ->getRepository("AdminBundle:Company")
                           ->findBy(array("status" => "Client"));
        
        
        $data = array("nombre" => count($companies));
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }


    /**
     * Récupération des entreprises
     * @Route("/get/{id}", name="api_company_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'une entreprise
     * @Route("/post", name="api_company_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'une entreprise
     * @Route("/edit/{id}", name="api_company_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'une entreprise
     * @Route("/delete/{id}", name="api_company_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
