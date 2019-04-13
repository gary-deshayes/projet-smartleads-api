<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        $repositoryContacts = $this->getDoctrine()->getRepository('AdminBundle:Contacts');
        $data["totalContacts"] = $repositoryContacts->getCountAllContacts();
        // $repositoryOperations = $this->getDoctrine()->getRepository("AdminBundle:Operations");
        // $data["operationsActives"] = $repositoryOperations->getNbOperationsActives();

        
        dump($data);
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            "data" => $data
        ]);
    }
}
