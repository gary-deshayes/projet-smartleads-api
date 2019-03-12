<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Form\ContactsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/contacts")
 */
class ContactsController extends AbstractController
{

    /**
     * Récupère le nombre de contacts pour chaque jour des 8 derniers jours passés
     * @Route("/getlastweeknewcontacts", name="api_contacts_getlastweeknewcontacts", methods={"GET"})
     */
    public function lastWeekNewContacts(){
        $contactsRepository = $this->getDoctrine()->getRepository("AdminBundle:Contacts");
        $dateNow = date("Y-m-d");
        $dateBefore = date("Y-m-d", strtotime('-7 days'));
        $query = $contactsRepository->createQueryBuilder("contacts")
             ->select("COUNT(contacts.createdAt) as nb, contacts.createdAt")
             ->where("contacts.createdAt => :date_debut")
             ->andWhere("contacts.createdAt <= :date_fin")
             ->groupby("contacts.createdAt")
             ->setParameter('date_debut', $dateBefore)
             ->setParameter('date_fin', $dateNow)
             ->getQuery();
           dump($query->getResult());
           SELECT COUNT(*), date(created_at) FROM contacts WHERE DATE(created_at) BETWEEN CURRENT_DATE()-8 AND CURRENT_DATE() GROUP BY DATE(created_at)



                        
        
        
        // $data = array("nombre" => count($companies));
        // $response = new Response(json_encode($data), 200);
        // $response->headers->set('Content-Type', 'application/json');
        // return $response;

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
