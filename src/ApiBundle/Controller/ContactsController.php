<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Contacts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contacts")
 */
class ContactsController extends AbstractController
{

    /**
     * Récupère le nombre de contacts pour chaque jour des 8 derniers jours passés
     * @Route("/getlastweeknewcontacts", name="api_contacts_getlastweeknewcontacts", methods={"GET"})
     */
    public function lastWeekNewContactsPerDay()
    {
        $query = $this->getDoctrine()->getRepository("AdminBundle:Contacts")->lastWeekNewContactsPerDay();
        $result = $query->execute();
        $data = array();
        if (count($result) > 0) {
            
            foreach ($result as $res) {
                $res_data = array(
                    "date" => $res["createdAt"],
                    "nombre" => $res["nb"],

                );
                array_push($data, $res_data);
            }
            $dataJson = [
                "data" => $data,
                "retour" => "1"
            ];
            $response = new Response(json_encode($dataJson), 200);
            $response->headers->set('Content-Type', 'application/json');

        } else {
            $dataJson = [
                "message" => "Aucune données pour cette plage horaires",
                "retour" => "2"
            ];
            $response = new Response(json_encode($dataJson), 200);
            $response->headers->set('Content-Type', 'application/json');
        }
        return $response;
    }

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
     * Récupération du nombre total de contacts
     * @Route("/getCountAll", name="api_contacts_getCountAll", methods={"GET"})
     */

    public function getCountAll(){
        $repo = $this->getDoctrine()->getRepository('AdminBundle:Contacts');
        $query = $repo->findAll();

        $data = array(
            "nombre" => count($query)
        );
        
        $dataJson = [
            "data" => $data,
            "retour" => "1"
        ];
        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }
    
    /**
     * Création d'un contact
     * @Route("/lastContactsSince/{since}", name="api_contacts_lastContactsSince", methods={"GET"})
     */
    public function lastContactsSince($since){
        $dateSince = "";
        switch($since){
            case "day":
                $dateSince = "-1 days";
            break;
            case "week":
                $dateSince = "-1 week";
            break;
            case "month":
                $dateSince = "-1 month";
            break;
            case "year":
                $dateSince = "-1 year";
            break;
        }
        dump($since);
        $query = $this->getDoctrine()->getRepository('AdminBundle:Contacts')->lastContactsSince($dateSince);
        dump($query->getResult());
        $response = new Response(json_encode($dateSince), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Création d'un contact
     * @Route("/post", name="api_contacts_post", methods={"POST"})
     */
    public function post()
    {

    }
    /**
     * Edition d'un contact
     * @Route("/edit/{id}", name="api_contacts_edit", methods={"PUT"})
     */
    public function edit()
    {
    }
    /**
     * Suppression d'un contact
     * @Route("/delete/{id}", name="api_contacts_delete", methods={"DELETE"})
     */
    public function delete()
    {
    }
}
