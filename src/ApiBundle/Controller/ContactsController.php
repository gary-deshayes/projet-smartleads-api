<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Form\ContactsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contacts")
 */
class ContactsController extends AbstractController
{
    /**
     * Total contact actif
     * @Route("/totalActif", name="total_contacts_actifs", methods={"GET"})
     */
    public function getContactsActifs(){
        $repo = $this->getDoctrine()->getRepository('AdminBundle:Contacts');
        $query = $repo->findBy(['status' => '1']);

        $data = array(
            "nombre" => count($query)
        );
        
        $response= new Response(json_encode($data, 200));

    }

    /**
     * Récupération des contacts
     * @Route("/get/{id}", name="api_contacts_get", methods={"GET"})
     */
    public function getter(){


    }
    /**
     * Création d'un contact
     * @Route("/post", name="api_contacts_post", methods={"POST"})
     */
    public function post(){
        
    }
    /**
     * Edition d'un contact
     * @Route("/edit/{id}", name="api_contacts_edit", methods={"PUT"})
     */
    public function edit(){
    }
    /**
     * Suppression d'un contact
     * @Route("/delete/{id}", name="api_contacts_delete", methods={"DELETE"})
     */
    public function delete(){
    }
}
