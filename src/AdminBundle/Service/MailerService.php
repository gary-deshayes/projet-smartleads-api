<?php

namespace App\AdminBundle\Service;

use Twig\Environment;
use Symfony\Component\Routing\RouterInterface;


class MailerService
{
    private $mailer;
    private $template;
    private $router;

    public function __construct(\Swift_Mailer $mailer, \Twig\Environment $template, RouterInterface $router){
        $this->mailer = $mailer;
        $this->template = $template;
        $this->router = $router;
    }

    public function send($salesperson, $token){

        $message = (new \Swift_Message('Mot de passe oublie ?'))
            // ->setFrom(getEnv("MAILER_FROM"))
            ->setFrom('smartleads.supp@outlook.com')
            ->setTo($salesperson->getEmail())
            ->setBody(
            $this->template->render(
                "reset_password/template.html.twig",
                [
                    "name" => $salesperson->getLastName(),
                    "firstName" => $salesperson->getFirstName(),
                    "link" => "/resetPasswordToken/" . $salesperson->getLastName() . "/" . $token,
                ]
            ),
            "text/html"
        );
        $this->mailer->send($message);
        
    }

}