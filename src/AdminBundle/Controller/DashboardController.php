<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\OperationSent;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Repository\OperationSentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $periodCalc = "-1 " . $period;
        //Data contacts
        $repositoryContacts = $this->getDoctrine()->getRepository(Contacts::class);
        $data["numberNewContactsSince"] = $repositoryContacts->getNumberNewContactsSince($periodCalc)->getSingleResult()["nb"];
        $data["numberContactsActive"] = count($repositoryContacts->findBy(array("status" => 1)));
        $data["pourcentNewContactsSince"] = $repositoryContacts->getPourcentageNewContacts($periodCalc);


        //Data entreprises
        $repositoryCompany = $this->getDoctrine()->getRepository(Company::class);
        $data["numberNewCompaniesSince"] = $repositoryCompany->getNumberNewCompaniesSince($periodCalc)->getSingleResult()["nb"];
        $data["numberCompaniesActive"] = count($repositoryCompany->findBy(array("actif" => 1)));
        $data["pourcentNewCompaniesSince"] = $repositoryCompany->getPourcentageNewCompanies($periodCalc);

        //Data Opération
        $repositoryOperationSent = $this->getDoctrine()->getRepository(OperationSent::class);
        $repositoryOperation = $this->getDoctrine()->getRepository(Operations::class);

        $data["numberSentMails"] = count($repositoryOperationSent->findAll());
        $data["numberOperationRealised"] = count($repositoryOperation->findBy(array("sent" => 1)));
        $data["numberNewMailsSince"] = $repositoryOperationSent->getNumberNewMailsSince($periodCalc)->getSingleResult()["nb"];
        $data["pourcentNewMailsSince"] = $repositoryOperationSent->getPourcentageNewMails($periodCalc);
        $data["numberOperationsActiveSince"] = $repositoryOperation->getNumberActivesOperationsSince($periodCalc)->getSingleResult()["nb"];
        $data["pourcentOperationsActiveSince"] = $repositoryOperation->getPourcentageOperationsActive($periodCalc);


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
