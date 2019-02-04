<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("admin/parameter", name="parameter")
*/
class ParameterController extends AbstractController
{
     /**
     * Edition d'un paramètrepar twig
     * @Route("/edit/{id}", name="Parameter_edit", methods={"GET","POST"})
     */
    public function edit()
    {

    }

    /**
     * Suppression d'un paramètre par twig
     * @Route("delete/{id}", name="Parameter_delete", methods={"GET"})
     */
    public function delete()
    {

    }

    /**
     * Création d'un paramètre par twig
     * @Route("/new", name="Parameter_new", methods={"GET","POST"})
     */
    public function new()
    {
        
    }

    /**
     * Affichage de la liste des paramètres par twig
     * @Route("/", name="Parameter_index", methods={"GET"})
     */
    public function index()
    {

    }

    /**
     * Affichage d'un message en cas de succès d'une requête
     * @Route("/success", name="ParameterGraphicStyles_success", methods={"GET"})
     */
    public function success()
    {

    }
}
