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
     * @Route("/totalActif", name="api_company_activeclient", methods={"GET"})
     */
    public function getActifClient()
    {
        $companies = $this->getDoctrine()
            ->getRepository("AdminBundle:Company")
            ->findBy(array("actif" => 1));

        $data = array(
                "data" => "company_actifs", 
                "value" => count($companies));
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

    /**
     * Récuperation des nouvelles entreprises depuis une période
     * @Route("/newCompaniesSince/{since}", name="api_company_newCompaniesSince", methods={"GET"})
     */
    public function getNewCompaniesSince($since)
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
        $query = $this->getDoctrine()->getRepository("AdminBundle:Company")->getNumberNewCompaniesSince($period)->getSingleResult()["nb"];
        $pourcent= $this->getDoctrine()->getRepository("AdminBundle:Company")->getPourcentageNewCompanies($period);
        $data = array(
            "data" => "company_news",
            "value" => $query,
            "pourcent" => $pourcent
        );
        
            $response = new Response(json_encode($data), 200);
            $response->headers->set('Content-Type', 'application/json');
 
        return $response;
    }

    /**
     * Récupération du pourcentage de nouvelles entreprises depuis la dernière periode
     * @Route("/getPourcentSinceLastPeriod/{since}", name="api_company_getpourcentsincelastperiod", methods={"GET"})
     */
    public function getPourcentNewCompanySinceLastPeriod($since)
    {
        $data = $this->getDoctrine()->getRepository(Company::class)->getPourcentageNewCompanies($since);
        $dataJson = array(
            "data" => $data,
            "retour" => 1
        );

        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Récupération du nombre de nouvelles entreprises depuis une période
     * @Route("/numberNewCompaniesSince/{since}", name="api_company_numberNewCompaniesSince", methods={"GET"})
     */
    public function getNumberNewCompaniesSince($since)
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
        $numberCompanies = $this->getDoctrine()
            ->getRepository("AdminBundle:Company")
            ->getNumberNewCompaniesSince($period);

        $data = array(
            "nombre" => $numberCompanies
        );

        $dataJson = array(
            "data" => $data,
            "retour" => 1
        );

        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
