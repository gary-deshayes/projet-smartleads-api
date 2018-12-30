<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="home")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route(contact/new", name="personae_create")
     * @Route("contact/{id}/edit", name="contact_edit")
     */
    public function form(Projet $projet = null, Request $request, ObjectManager $manager)
    {
        if($projet == null)
        {
            $projet = new Projet();
        }

        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($projet);
            $manager->flush();

            return $this->redirectToRoute('projet_show', ['id' => $projet->getId()]);
        }

        
        return $this->render('site/create.html.twig', [
            'formProjet' => $form->createView(),
            'editMode' => $projet->getId() !== null

        ]);
    }
}
