<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Contacts;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Repository\SettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    private $settingsApplication;

    public function __construct(SettingsRepository $settingsRepo)
    {
        $this->settingsApplication = $settingsRepo
        ->findOneBy(array("id" => "1"));
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, ObjectManager $manager): Response
    {   
        if($this->getUser() != null){
            return $this->redirectToRoute("dashboard", array("period" => "today"));
        }
        $messReset = "";
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, "settingsApplication" => $this->settingsApplication]);
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(){

    }

    
}


