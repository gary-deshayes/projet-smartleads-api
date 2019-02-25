<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\ObjectTable;
use App\AdminBundle\Form\ObjectTableType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objecttable")
 */
class ObjectTableController extends AbstractController
{
    /**
     * Récupération des objets
     * @Route("/get/{id}", name="api_objecttable_get", methods={"GET"})
     */
    public function getter(){
    }
    /**
     * Création d'un objet
     * @Route("/post", name="api_objecttable_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un objet
     * @Route("/edit/{id}", name="api_objecttable_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un objet
     * @Route("/delete/{id}", name="api_objecttable_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
