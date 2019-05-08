<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Country;
use App\AdminBundle\Entity\Settings;
use App\AdminBundle\Entity\Turnovers;
use App\AdminBundle\Form\CountryType;
use App\AdminBundle\Entity\Department;
use App\AdminBundle\Form\SettingsType;
use App\AdminBundle\Form\TurnoversType;
use App\AdminBundle\Entity\AffectedArea;
use App\AdminBundle\Form\ProfessionType;
use App\AdminBundle\Entity\CompanyStatus;
use App\AdminBundle\Form\LegalStatusType;
use App\AdminBundle\Entity\DecisionMaking;
use App\AdminBundle\Form\ActivityAreaType;
use App\AdminBundle\Form\AffectedAreaType;
use App\AdminBundle\Form\CompanyStatusType;
use App\AdminBundle\Form\DecisionMakingType;
use App\AdminBundle\Form\NumberEmployeesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Proxies\__CG__\App\AdminBundle\Entity\Profession;
use Proxies\__CG__\App\AdminBundle\Entity\LegalStatus;
use Proxies\__CG__\App\AdminBundle\Entity\ActivityArea;
use Proxies\__CG__\App\AdminBundle\Entity\NumberEmployees;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/settings")
 */
class SettingsController extends AbstractController
{
    /**
     * @Route("/", name="settings_index", methods={"GET", "POST"})
     * @IsGranted("ROLE_DIRECTEUR", statusCode=403)
     */
    public function index(Request $request): Response
    {
        //On récupère la ligne des paramètres application
        $settings = $this->getDoctrine()
            ->getRepository(Settings::class)
            ->findOneBy(array("id" => "1"));

        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($settings);
            $entityManager->flush();
        }

        //Gère les ajouts et modifications des professions
        if ($request->get('profession') != null) {
            $arrayProfession = $request->get('profession');
            if (isset($arrayProfession["id"])) {
                $professionEdit = $this->getDoctrine()
                    ->getRepository(Profession::class)
                    ->findOneBy(array("id" => $arrayProfession["id"]));
                $professionEdit->setLibelle($arrayProfession["libelle"]);
            } else {
                $newProfession = new Profession();
                $newProfession->setLibelle($arrayProfession["libelle"]);
                $entityManager = $this->getDoctrine()->getManager()->persist($newProfession);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        //Récupère la partie métier
        $profession = new Profession();
        $formProfessionAdd = $this->createForm(ProfessionType::class, $profession);
        $formProfessionEdit = $this->createForm(ProfessionType::class);
        $professions = $this->getDoctrine()->getRepository(Profession::class)->findAll();


        //Gère les ajouts et modifications des pouvoirs décisionnel
        if ($request->get('decision_making') != null) {
            $arrayDecision = $request->get('decision_making');
            if (isset($arrayDecision["id"])) {
                $decisionEdit = $this->getDoctrine()
                    ->getRepository(DecisionMaking::class)
                    ->findOneBy(array("id" => $arrayDecision["id"]));
                $decisionEdit->setLibelle($arrayDecision["libelle"]);
            } else {
                $newDecision = new DecisionMaking();
                $newDecision->setLibelle($arrayDecision["libelle"]);
                $entityManager = $this->getDoctrine()->getManager()->persist($newDecision);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        //Récupère la partie pouvoir décisionnel
        $decision = new DecisionMaking();
        $formDecisionAdd = $this->createForm(DecisionMakingType::class, $decision);
        $formDecisionEdit = $this->createForm(DecisionMakingType::class);

        $decisions = $this->getDoctrine()->getRepository(DecisionMaking::class)->findAll();

        //Gère les ajouts et modifications des pouvoirs décisionnel
        if ($request->get('company_status') != null) {
            $arrayStatus = $request->get('company_status');
            if (isset($arrayStatus["id"])) {
                $statusEdit = $this->getDoctrine()
                    ->getRepository(CompanyStatus::class)
                    ->findOneBy(array("id" => $arrayStatus["id"]));
                $statusEdit->setLibelle($arrayStatus["libelle"]);
                $statusEdit->setColor($arrayStatus["color"]);
            } else {
                $newStatus = new CompanyStatus();
                $newStatus->setLibelle($arrayStatus["libelle"]);
                $newStatus->setColor($arrayStatus["color"]);
                $entityManager = $this->getDoctrine()->getManager()->persist($newStatus);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        //Récupère la partie pouvoir décisionnel
        $state = new CompanyStatus();
        $formStatusAdd = $this->createForm(CompanyStatusType::class, $state);
        $formStatusEdit = $this->createForm(CompanyStatusType::class);
        $companyStatus = $this->getDoctrine()->getRepository(CompanyStatus::class)->findAll();

        //Gère les ajouts et modifications des secteurs d'activités (Code naf)
        if ($request->get('activity_area') != null) {
            $arrayActivity = $request->get('activity_area');
            if (isset($arrayActivity["id"])) {
                $activityEdit = $this->getDoctrine()
                    ->getRepository(ActivityArea::class)
                    ->findOneBy(array("id" => $arrayActivity["id"]));
                $activityEdit->setLibelle($arrayActivity["libelle"]);
            } else {
                $newActivity = new ActivityArea();
                $newActivity->setLibelle($arrayActivity["libelle"]);
                $entityManager = $this->getDoctrine()->getManager()->persist($newActivity);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        //Récupère la partie secteurs d'activités
        $activityArea = new ActivityArea();
        $formActivityAdd = $this->createForm(ActivityAreaType::class, $activityArea);
        $formActivityEdit = $this->createForm(ActivityAreaType::class);
        $activityAreas = $this->getDoctrine()->getRepository(ActivityArea::class)->findAll();

        //Gère les ajouts et modifications des status légaux des entreprises
        if ($request->get('legal_status') != null) {
            $arrayLegalStatus = $request->get('legal_status');
            if (isset($arrayLegalStatus["id"])) {
                $legalStatusEdit = $this->getDoctrine()
                    ->getRepository(LegalStatus::class)
                    ->findOneBy(array("id" => $arrayLegalStatus["id"]));
                $legalStatusEdit->setLibelle($arrayLegalStatus["libelle"]);
            } else {
                $newLegalStatus = new LegalStatus();
                $newLegalStatus->setLibelle($arrayLegalStatus["libelle"]);
                $entityManager = $this->getDoctrine()->getManager()->persist($newLegalStatus);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        //Récupère la partie status légaux des entreprises
        $legalStatu = new LegalStatus();
        $formLegalStatusAdd = $this->createForm(LegalStatusType::class, $legalStatu);
        $formLegalStatusEdit = $this->createForm(LegalStatusType::class);
        $legalStatus = $this->getDoctrine()->getRepository(LegalStatus::class)->findAll();

        //Gère les ajouts et modifications des effectifs des entreprises
        if ($request->get('number_employees') != null) {
            $arrayNumberEmployees = $request->get('number_employees');
            if (isset($arrayNumberEmployees["id"])) {
                $numberEmployeesEdit = $this->getDoctrine()
                    ->getRepository(NumberEmployees::class)
                    ->findOneBy(array("id" => $arrayNumberEmployees["id"]));
                $numberEmployeesEdit->setLibelle($arrayNumberEmployees["libelle"]);
            } else {
                $newNumberEmployees = new NumberEmployees();
                $newNumberEmployees->setLibelle($arrayNumberEmployees["libelle"]);
                $entityManager = $this->getDoctrine()->getManager()->persist($newNumberEmployees);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        //Récupère la partie effectifs des entreprises
        $numberEmployee = new NumberEmployees();
        $formNumberEmployeesAdd = $this->createForm(NumberEmployeesType::class, $numberEmployee);
        $formNumberEmployeesEdit = $this->createForm(NumberEmployeesType::class);
        $numberEmployees = $this->getDoctrine()->getRepository(NumberEmployees::class)->findAll();

        //Gère les ajouts et modifications des chiffre d'affaires d'entreprises
        if ($request->get('turnovers') != null) {
            $arrayTurnovers = $request->get('turnovers');
            if (isset($arrayTurnovers["id"])) {
                $turnoversEdit = $this->getDoctrine()
                    ->getRepository(Turnovers::class)
                    ->findOneBy(array("id" => $arrayTurnovers["id"]));
                $turnoversEdit->setLibelle($arrayTurnovers["libelle"]);
            } else {
                $newTurnovers = new Turnovers();
                $newTurnovers->setLibelle($arrayTurnovers["libelle"]);
                $entityManager = $this->getDoctrine()->getManager()->persist($newTurnovers);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        //Récupère la partie chiffre d'affaires d'entreprises
        $turnover = new Turnovers();
        $formTurnoversAdd = $this->createForm(TurnoversType::class, $turnover);
        $formTurnoversEdit = $this->createForm(TurnoversType::class);
        $turnovers = $this->getDoctrine()->getRepository(Turnovers::class)->findAll();






        $affectedAreaEdit = null;



        //Gère la partie zone affecté des commerciaux
        if ($request->get('affected_area') != null) {
            $arrayAffectedArea = $request->get('affected_area');
            if (isset($arrayAffectedArea["id"]) && $arrayAffectedArea["id"] != "") {
                $affectedAreaEdit = $this->getDoctrine()
                    ->getRepository(AffectedArea::class)
                    ->findOneBy(array("id" => $arrayAffectedArea["id"]));
            } else {
                $newAffectedArea = new AffectedArea();
                $this->getDoctrine()->getManager()->persist($newAffectedArea);
                $newAffectedArea->setLibelle($arrayAffectedArea["libelle"]);


                if ($arrayAffectedArea["departments"] != null){
                    $depts = $this->getDoctrine()->getRepository(Department::class)->getDepartmentInArray($arrayAffectedArea["departments"])->getResult();
                    
                    foreach($depts as $dept){
                        $dept->setAffectedArea($newAffectedArea);
                        $this->getDoctrine()->getManager()->persist($dept);
                        
                    }
                    
                }
                
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('settings_index');
            }
        }


        //Récupère la partie zone affecté des zones
        $affectedArea = new AffectedArea();
        $formAffectedAreaAdd = $this->createForm(AffectedAreaType::class, $affectedArea);
        $formAffectedAreaEdit = $this->createForm(AffectedAreaType::class, $affectedAreaEdit);
        if ($affectedAreaEdit != null) {
            $formAffectedAreaEdit->handleRequest($request);
        }
        if ($formAffectedAreaEdit->isSubmitted() && $formAffectedAreaEdit->isValid()) {
            //Récupère les départments lié à la zone
            $departmentAffectedArea = $this->getDoctrine()->getRepository(Department::class)->getDepartmentAffectedArea($affectedAreaEdit->getId());

            //Département envoyé par le formulaire
            $departmentsToAdd = $affectedAreaEdit->getDepartments();

            //On fait une suppression sinon ca marche pas
            $affectedAreaEdit->removeAllDepartment();
            foreach ($departmentsToAdd as $depts) {
                //On lie les départements à la zone 
                $depts->setAffectedArea($affectedAreaEdit);
            }
            //Contient les départements qui ne sont plus envoyé par le formulaire mais toujours présent dans la base
            $departmentsToRemove = array_diff($departmentAffectedArea->getResult(), $departmentsToAdd->toArray());
            foreach ($departmentsToRemove as $deptsRm) {
                $deptsRm->setAffectedArea(null);
            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        $affectedAreas = $this->getDoctrine()->getRepository(AffectedArea::class)->findAll();
        foreach ($affectedAreas as $area) {
            $area->setAllDepartments($this->getDoctrine()->getRepository(Department::class)->getDepartmentAffectedArea($area->getId())->getResult());
        }




        
        //Gère les pays
        if ($request->get('country') != null) {
            $arrayCountry = $request->get('country');
            if (isset($arrayCountry["code"])) {
                $countryEdot = $this->getDoctrine()
                    ->getRepository(Country::class)
                    ->findOneBy(array("code" => $arrayCountry["code"]));
                $countryEdot->setLibelle($arrayCountry["libelle"]);
            } else {
                $newCountry = new Country();
                
                $newCountry->setLibelle($arrayCountry["libelle"]);
                $newCountry->setCode($arrayCountry["code"]);
                $entityManager = $this->getDoctrine()->getManager()->persist($newCountry);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        //Récupère la partie pays
        $country = new Country();
        $formCountryAdd = $this->createForm(CountryType::class, $country);
        $formCountryEdit = $this->createForm(CountryType::class);
        $countries = $this->getDoctrine()->getRepository(Country::class)->findAll();

        
        return $this->render('settings/index.html.twig', [
            'settings' => $settings,
            'form' => $form->createView(),

            'professions' => $professions,
            'formProfessionAdd' => $formProfessionAdd->createView(),
            'formProfessionEdit' => $formProfessionEdit->createView(),

            'decisions' => $decisions,
            'formDecisionAdd' => $formDecisionAdd->createView(),
            'formDecisionEdit' => $formDecisionEdit->createView(),

            'companyStatus' => $companyStatus,
            'formStatusAdd' => $formStatusAdd->createView(),
            'formStatusEdit' => $formStatusEdit->createView(),

            'activityAreas' => $activityAreas,
            'formActivityAdd' => $formActivityAdd->createView(),
            'formActivityEdit' => $formActivityEdit->createView(),

            'legalStatus' => $legalStatus,
            'formLegalStatusAdd' => $formLegalStatusAdd->createView(),
            'formLegalStatusEdit' => $formLegalStatusEdit->createView(),

            'numberEmployees' => $numberEmployees,
            'formNumberEmployeesAdd' => $formNumberEmployeesAdd->createView(),
            'formNumberEmployeesEdit' => $formNumberEmployeesEdit->createView(),

            'turnovers' => $turnovers,
            'formTurnoversAdd' => $formTurnoversAdd->createView(),
            'formTurnoversEdit' => $formTurnoversEdit->createView(),

            'affectedAreas' => $affectedAreas,
            'formAffectedAreaAdd' => $formAffectedAreaAdd->createView(),
            'formAffectedAreaEdit' => $formAffectedAreaEdit->createView(),

            'countries' => $countries,
            'formCountryAdd' => $formCountryAdd->createView(),
            'formCountryEdit' => $formCountryEdit->createView(),
        ]);
    }
}
