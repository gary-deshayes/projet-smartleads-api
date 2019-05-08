<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ActivityArea;
use App\AdminBundle\Form\ActivityAreaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Entity\AffectedArea;

/**
 * @Route("/affectedarea")
 */
class AffectedAreaController extends AbstractController
{
    /**
     * @Route("/getdepartments/{affectedArea}", name="activity_area_departments", methods={"GET"})
     */
    public function getDepartments(AffectedArea $affectedArea): Response
    {
        $query = $this->getDoctrine()->getRepository("AdminBundle:Department")->getDepartmentAffectedArea($affectedArea);
        $result = $query->execute();
        $dataFormatted = [];

        foreach ($result as $depts) {
            array_push($dataFormatted, $depts->getId());
        }

        $dataJson = [
            "data" => $dataFormatted,
            "retour" => "1"
        ];
        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/getdepartmentswithaffectedarea/", name="activity_area_departmentswwithaffectedarea", methods={"GET"})
     */
    public function getDepartmentsWithAffectedArea(): Response
    {
        $query = $this->getDoctrine()->getRepository("AdminBundle:Department")->getDepartmentWithAffectedArea();
        $result = $query->execute();
        $dataFormatted = [];

        foreach ($result as $depts) {
            array_push($dataFormatted, $depts->getId());
        }

        $dataJson = [
            "data" => $dataFormatted,
            "retour" => "1"
        ];
        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
