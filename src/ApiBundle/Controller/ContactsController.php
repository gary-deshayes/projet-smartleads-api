<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Contacts;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
/**
 * @Route("/contacts")
 */
class ContactsController extends AbstractController
{

    /**
     * Récupère le nombre de contacts pour chaque jour de la période demandé
     * @Route("/getNumberNewContactsPerDay/{since}", name="api_contacts_getnumbernewcontactsperday", methods={"GET"})
     */
    public function getNumberNewContactsPerDay($since)
    {
        $period = "";
        switch($since){
            case "day":
                $period = "-1 days";
            break;
            case "week":
                $period = "-1 week";
            break;
            case "month":
                $period = "-1 month";
            break;
            case "year":
                $period = "-1 year";
            break;
        }
        $query = $this->getDoctrine()->getRepository("AdminBundle:Contacts")->getNumberNewContactsPerDay($period);
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
                "retour" => "-1"
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
    public function getContactsActifs(Request $request){
        
        $repo = $this->getDoctrine()->getRepository('AdminBundle:Contacts');
        $query = $repo->findBy(['status' => '1']);

        $data = array(
            "data" => "contacts_actifs",
            "value" => count($query)
        );
        
        $response = new Response(json_encode($data));
        return $response;
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
     * @Route("/getNumberNewContactsSince/{since}", name="api_contacts_getNumberNewContactsSince", methods={"GET"})
     */
    public function getNumberNewContactsSince($since){
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

        $query = $this->getDoctrine()->getRepository('AdminBundle:Contacts')->getNumberNewContactsSince($dateSince)->getSingleResult()["nb"];
        $pourcent = $this->getDoctrine()->getRepository('AdminBundle:Contacts')->getPourcentageNewContacts($dateSince);
        $data = array(
            "data" => "new_contacts",
            "value" => $query,
            "pourcent" => $pourcent
            
        );
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

    /**
     * Récupère le nombre de contacts pour chaque jour de la période demandé
     * @Route("/getNumberContactsUpdatedPerDay/{since}", name="api_contacts_getnumbernewcontactsupdatedperday", methods={"GET"})
     */
    public function getNumberContactsUpdatedPerDay($since)
    {
        $period = "";
        switch($since){
            case "day":
                $period = "-1 days";
            break;
            case "week":
                $period = "-1 week";
            break;
            case "month":
                $period = "-1 month";
            break;
            case "year":
                $period = "-1 year";
            break;
        }
        $query = $this->getDoctrine()->getRepository("AdminBundle:Contacts")->getNumberContactsUpdatedPerDay($period);
        $result = $query->execute();
        $data = array();
        if (count($result) > 0) {
            
            foreach ($result as $res) {
                $res_data = array(
                    "date" => $res["updatedAt"],
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
                "retour" => "-1"
            ];
            $response = new Response(json_encode($dataJson), 200);
            $response->headers->set('Content-Type', 'application/json');
        }
        return $response;
    }
}
