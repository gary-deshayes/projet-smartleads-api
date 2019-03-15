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
    public function lastWeekNewContacts()
    {
        $contactsRepository = $this->getDoctrine()->getRepository("AdminBundle:Contacts");
        date_default_timezone_set('Europe/Paris');
        $dateNow = date("Y-m-d H:i");
        $dateBefore = date("Y-m-d 00:00", strtotime('-8 days'));
        $query = $contactsRepository->createQueryBuilder("contacts")
            ->select("COUNT(contacts.createdAt) as nb, DATE(contacts.createdAt) as createdAt")
            ->where("DATE(contacts.createdAt) BETWEEN :date_debut AND :date_fin")
            ->groupby("createdAt")
            ->setParameter('date_debut', $dateBefore)
            ->setParameter('date_fin', $dateNow)
            ->getQuery();
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
     * Récupération des contacts
     * @Route("/get/{id}", name="api_contacts_get", methods={"GET"})
     */
    public function getter()
    {
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
