<?php

namespace App\AdminBundle\Service;

use Twig\Environment;
use Symfony\Component\Routing\RouterInterface;
use App\AdminBundle\Entity\Operations;
use Proxies\__CG__\App\AdminBundle\Entity\SettingsOperation;

class MailerService
{
    private $mailer;
    private $template;
    private $router;

    public function __construct(\Swift_Mailer $mailer, \Twig\Environment $template, RouterInterface $router)
    {
        $this->mailer = $mailer;
        $this->template = $template;
        $this->router = $router;
    }

    public function send($salesperson, $token)
    {

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
                        "link" => $_SERVER["HTTP_ORIGIN"] .  "/resetPasswordToken/" . $salesperson->getLastName() . "/" . $token,
                    ]
                ),
                "text/html"
            );
        $this->mailer->send($message);
    }

    public function send_operation(Operations $operation, $contact, SettingsOperation $settings_operation, $uniqid)
    {
        dump($operation);
        dump($contact);
        dump($settings_operation);

        $message = (new \Swift_Message($settings_operation->getMailObject()))
            // ->setFrom(getEnv("MAILER_FROM"))
            ->setFrom('smartleads.supp@outlook.com')
            ->setTo("deshayesgary@hotmail.fr")
            ->setBody(
                $this->template->render(
                    "operations/mail_view.html.twig",
                    [
                        "nom" => $contact->getFirstName(),
                        "prenom" => $contact->getLastName(),
                        "texte" => $settings_operation->getTextMail(),
                        "settings_operation" => $settings_operation,
                        "link" => $_SERVER['REMOTE_ADDR'] . "/operation/" . $operation->getName() . "/" . $uniqid
                    ]
                ),
                "text/html"
            );
        $this->mailer->send($message);
    }
}
