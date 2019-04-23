<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Settings;
use App\AdminBundle\Form\SettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $settings = $this->getDoctrine()
            ->getRepository(Settings::class)
            ->findOneBy(array("id" => "1"));

        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($settings);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($settings);
            $entityManager->flush();

            return $this->render('settings/index.html.twig', [
                'settings' => $settings,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('settings/index.html.twig', [
            'settings' => $settings,
            'form' => $form->createView(),
        ]);
    }

    
}
