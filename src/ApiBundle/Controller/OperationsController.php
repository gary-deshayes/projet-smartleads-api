<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\OperationsSent;
use App\AdminBundle\Form\OperationsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operations")
 */
class OperationsController extends AbstractController
{
    /**
     * Récupération des opérations actives
     * @Route("/operationsActiveSince/{since}", name="api_operation_operationsSince", methods={"GET"})
     */
    public function getOperationsActiveSince($since){
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

        $query = $this->getDoctrine()->getRepository('AdminBundle:Operations')->getNumberActivesOperationsSince($dateSince)->getSingleResult()["nb"];
        $pourcent = $this->getDoctrine()->getRepository('AdminBundle:Operations')->getPourcentageOperationsActive($dateSince);
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
     * Récupération des opération réalisé
     * @Route("/operationsRealized", name="operations_realisees", methods={"GET"})
     */
    public function getOperationsRealized(Request $request){
        
        $repo = $this->getDoctrine()->getRepository('AdminBundle:Operations');
        $query = count($repo->findAll());

        $data = array(
            "data" => "operations_realized",
            "value" => $query
        );
        
        $response = new Response(json_encode($data));
        return $response;
    }

    /**
     * Récupération des opérations
     * @Route("/getrelease", name="api_operations_getrelease", methods={"GET"})
     */
    public function operation_release()
    {
        $repoOpeSent = $this->getDoctrine()->getRepository("AdminBundle:OperationSent");
        $query = $repoOpeSent->createQueryBuilder('operation')
            ->select("COUNT(DISTINCT operation.idOperation) as nombre")->getQuery();

        $data = array("nombre" => $query->getResult()[0]["nombre"]);
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
     * Récuperations des opérations actives pendant la durée
     * @Route("/operationsActives/{between}", name="api_operations_operationsActivesBetween", methods={"GET"})
     */
    public function operationsActives($between)
    {
        $dateBetween = "";
        switch ($between) {
            case "day":
                $dateBetween = "-1 days";
                break;
            case "week":
                $dateBetween = "-1 week";
                break;
            case "month":
                $dateBetween = "-1 month";
                break;
            case "year":
                $dateBetween = "-1 year";
                break;
        }
        $query = $this->getDoctrine()->getRepository('AdminBundle:Operations')->getNbOperationsActives($dateBetween);
        $data = array(
            "nombre" => $query[0]["nb"]
        );
        $dataJson = [
            "data" => $data,
            "retour" => 1
        ];
        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Récupère le nombre de nouvelles opérations pour chaque jour de la période
     * @Route("/getNumberOperationsPerDay/{since}", name="api_operations_getnumbernewoperationsperday", methods={"GET"})
     */
    public function getNumberOperationsPerDay($since)
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
        $query = $this->getDoctrine()->getRepository("AdminBundle:Operations")->getNumberOperationsPerDay($period);
        $result = $query->execute();
        $data = array();
        if (count($result) > 0) {

            foreach ($result as $res) {
                $res_data = array(
                    "date" => $res["created_at"],
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
