<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Settings;
use App\AdminBundle\Form\SettingsType;
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
     * @Route("/", name="settings_index", methods={"GET"})
     */
    public function index(): Response
    {
        $settings = $this->getDoctrine()
            ->getRepository(Settings::class)
            ->findAll();

        return $this->render('settings/index.html.twig', [
            'settings' => $settings,
        ]);
    }

    /**
     * @Route("/new", name="settings_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $setting = new Settings();
        $form = $this->createForm(SettingsType::class, $setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($setting);
            $entityManager->flush();

            return $this->redirectToRoute('settings_index');
        }

        return $this->render('settings/new.html.twig', [
            'setting' => $setting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="settings_show", methods={"GET"})
     */
    public function show(Settings $setting): Response
    {
        return $this->render('settings/show.html.twig', [
            'setting' => $setting,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="settings_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Settings $setting): Response
    {
        $form = $this->createForm(SettingsType::class, $setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('settings_index', [
                'id' => $setting->getId(),
            ]);
        }

        return $this->render('settings/edit.html.twig', [
            'setting' => $setting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="settings_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Settings $setting): Response
    {
        if ($this->isCsrfTokenValid('delete'.$setting->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($setting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('settings_index');
    }
}
