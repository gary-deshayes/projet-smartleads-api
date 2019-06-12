<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\OperationSent;
use App\AdminBundle\Form\OperationSentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operationsent")
 */
class OperationSentController extends AbstractController
{
    /**
     * Récupération des nouveaux emails
     * @Route("/newMailsSince/{since}", name="api_operation_newMailsSince", methods={"GET"})
     */
    public function getNewMailsSince($since){
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

        $query = $this->getDoctrine()->getRepository('AdminBundle:OperationSent')->getNumberNewMailsSince($dateSince)->getSingleResult()["nb"];
        $pourcent = $this->getDoctrine()->getRepository('AdminBundle:OperationSent')->getPourcentageNewMails($dateSince);
        $data = array(
            "data" => "new_mails",
            "value" => $query,
            "pourcent" => $pourcent
            
        );
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

    /**
     * Total Mails actif
     * @Route("/totalMails", name="total_mails", methods={"GET"})
     */
    public function getTotalMails(Request $request){
        
        $repo = $this->getDoctrine()->getRepository('AdminBundle:OperationSent');
        $query = count($repo->findAll());

        $data = array(
            "data" => "total_mails",
            "value" => $query
        );
        
        $response = new Response(json_encode($data));
        return $response;
    }

    /**
     * Récupère le nombre de nouveaux email opérations pour chaque jour de la période
     * @Route("/numberNewMailsPerDay/{since}", name="api_operations_getnumbernewmailsperday", methods={"GET"})
     */
    public function getNumberNewMailsPerDay($since)
    {
        $period = "";
        switch ($since) {
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
        $query = $this->getDoctrine()->getRepository("AdminBundle:OperationSent")->getNumberNewMailPerDay($period);
        $result = $query->execute();
        $data = array();
        if (count($result) > 0) {

            foreach ($result as $res) {
                $res_data = array(
                    "date" => $res["sent_at"],
                    "nombre" => $res["nb"],

                );
                array_push($data, $res_data);
            }
            $dataJson = [
                "data" => "number_new_mails_per_day",
                "value" => $data,
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
