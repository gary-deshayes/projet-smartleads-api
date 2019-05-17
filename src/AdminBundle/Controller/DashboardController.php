<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("dashboard/{period}", name="dashboard")
     */
    public function dashboard($period)
    {
        $periods = array("today", "week", "month", "year");
        //Si il y a une mauvaise période on mets sur today de base
        if(!in_array($period, $periods)){
            $period = "today";
        }
        if($period == "today"){
            $period = "day";
        }
        $period = "-1 " . $period;
        //Data contacts
        $repositoryContacts = $this->getDoctrine()->getRepository('AdminBundle:Contacts');
        $data["numberNewContactsSince"] = $repositoryContacts->getNumberNewContactsSince($period)->getSingleResult()["nb"];

        //Data entreprises
        $repositoryCompany = $this->getDoctrine()->getRepository('AdminBundle:Company');
        $data["numberNewCompaniesSince"] = $repositoryCompany->getNumberNewCompaniesSince($period)->getSingleResult()["nb"];

        dump($data);
        // $repositoryOperations = $this->getDoctrine()->getRepository("AdminBundle:Operations");
        // $data["operationsActives"] = $repositoryOperations->getNbOperationsActives();

        
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            "data" => $data,
            "period" => $period
        ]);
    }

    /**
     * @Route("dashboard", name="dashboard_redirect")
     * Permet de rediriger si quelqu'un enlève le paramètre de période
     */
    public function redirectToDashboardToday()
    {
        return $this->redirectToRoute('dashboard', ['period' => "today"]);
    }
}
