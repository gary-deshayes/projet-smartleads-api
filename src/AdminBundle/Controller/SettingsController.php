<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Settings;
use App\AdminBundle\Form\SettingsType;
use App\AdminBundle\Form\ProfessionType;
use App\AdminBundle\Entity\CompanyStatus;
use App\AdminBundle\Entity\DecisionMaking;
use App\AdminBundle\Form\ActivityAreaType;
use App\AdminBundle\Form\CompanyStatusType;
use App\AdminBundle\Form\DecisionMakingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Proxies\__CG__\App\AdminBundle\Entity\Profession;
use Proxies\__CG__\App\AdminBundle\Entity\ActivityArea;
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
            } else {
                $newStatus = new CompanyStatus();
                $newStatus->setLibelle($arrayStatus["libelle"]);
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
            $arrayStatus = $request->get('activity_area');
            if (isset($arrayStatus["id"])) {
                $activityEdit = $this->getDoctrine()
                    ->getRepository(ActivityArea::class)
                    ->findOneBy(array("id" => $arrayStatus["id"]));
                $activityEdit->setLibelle($arrayStatus["libelle"]);
            } else {
                $newActivity = new ActivityArea();
                $newActivity->setLibelle($arrayStatus["libelle"]);
                $entityManager = $this->getDoctrine()->getManager()->persist($newActivity);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('settings_index');
        }
        //Récupère la partie pouvoir décisionnel
        $activityArea = new ActivityArea();
        $formActivityAdd = $this->createForm(ActivityAreaType::class, $activityArea);
        $formActivityEdit = $this->createForm(ActivityAreaType::class);
        $activityAreas = $this->getDoctrine()->getRepository(ActivityArea::class)->findAll();

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
        ]);
    }

}
