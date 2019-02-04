<?php

namespace App\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/parameter", name="api_parameter")
 */
class ParameterController extends AbstractController
{
    /**
     * Récupération d'un paramètre
     * @Route("/get/{id}", name="api_Parameter_get", methods={"GET"})
     */
    public function recuperation(){

    }

    /**
     * Création d'un paramètre
     * @Route("/post", name="api_Parameter_post", methods={"POST"})
     */
    public function post(){

    }


    /**
     * Edition du paramètre
     * @Route("/edit/{id}", name="api_Parameter_edit", methods={"PUT"})
     */
    public function edit(){

    }

    /**
     * Suppression du paramètre
     * @Route("/delete/{id}", name="api_Parameter_delete", methods={"DELETE"})
     */
    public function delete(){

    }
}
