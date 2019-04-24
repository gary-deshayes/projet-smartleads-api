<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Settings;
use App\AdminBundle\Form\SettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Form\ProfessionType;
use Proxies\__CG__\App\AdminBundle\Entity\Profession;
use App\AdminBundle\Entity\DecisionMaking;
use App\AdminBundle\Form\DecisionMakingType;

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

        //Récupère la partie métier
        $profession = new Profession();
        $formProfession = $this->createForm(ProfessionType::class, $profession);

        if ($formProfession->isSubmitted() && $formProfession->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profession);
            $entityManager->flush();
        }
        $professions = $this->getDoctrine()->getRepository(Profession::class)->findAll();

       //Récupère la partie pouvoir décisionnel
        $decision = new DecisionMaking();
        $formDecisionMaking = $this->createForm(DecisionMakingType::class, $decision);

        if ($formDecisionMaking->isSubmitted() && $formDecisionMaking->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($decision);
            $entityManager->flush();
        }
        $decisions = $this->getDoctrine()->getRepository(DecisionMaking::class)->findAll();

        return $this->render('settings/index.html.twig', [
            'settings' => $settings,
            'professions' => $professions,
            'form' => $form->createView(),
            'formProfession' => $formProfession->createView(),
            'decisions' => $decisions,
            'formDecisionMaking' => $formDecisionMaking->createView()
        ]);
    }

    
}
