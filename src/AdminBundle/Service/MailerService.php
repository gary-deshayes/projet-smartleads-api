<?php

namespace App\AdminBundle\Service;

use Twig\Environment;
use Symfony\Component\Routing\RouterInterface;
use App\AdminBundle\Entity\Operations;
use Proxies\__CG__\App\AdminBundle\Entity\SettingsOperation;
use \Mailjet\Resources;

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
                        "link" => $_SERVER['HTTP_REFERER'] .  "/resetPasswordToken/" . $salesperson->getLastName() . "/" . $token,
                    ]
                ),
                "text/html"
            );
        $this->mailer->send($message);
    }

    public function send_operation(Operations $operation, $contact, SettingsOperation $settings_operation, $uniqid)
    {
        $mj = new \Mailjet\Client(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'));

        $body = [
            'FromEmail' => "smartleads.supp@outlook.com",
            'FromName' => "Smartleads No reply",
            'Subject' => $settings_operation->getMailObject(),
            'Html-part' => $this->template->render(
                "operations/mail_view.html.twig",
                [
                    "nom" => $contact->getFirstName(),
                    "prenom" => $contact->getLastName(),
                    "texte" => $settings_operation->getTextMail(),
                    "settings_operation" => $settings_operation,
                    "link" => "/operation/" . $operation->getName() . "/" . $uniqid
                ]
            ),
            'Recipients' => [
                [
                    'Email' => "smartleads@mailforspam.com"
                ]
            ]
        ];
        dump($body);
        
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        if($response->success()){
            $messageID = $response->getData();
            $data = array(
                "retour" => 1,
                "messageID" => $response->getData()["Sent"][0]["MessageID"]

            );
        } else {
            $data = array(
                "retour" => 0
            );
        }
        return $data;

        // $message = (new \Swift_Message($settings_operation->getMailObject()))
        //     // ->setFrom(getEnv("MAILER_FROM"))
        //     ->setFrom('smartleads.supp@outlook.com')
        //     ->setTo("smartleads@mailforspam.com")
        //     ->setBody(
        //         $this->template->render(
        //             "operations/mail_view.html.twig",
        //             [
        //                 "nom" => $contact->getFirstName(),
        //                 "prenom" => $contact->getLastName(),
        //                 "texte" => $settings_operation->getTextMail(),
        //                 "settings_operation" => $settings_operation,
        //                 "link" => $_SERVER['HTTP_REFERER'] . "/operation/" . $operation->getName() . "/" . $uniqid
        //             ]
        //         ),
        //         "text/html"
        //     );
        // $this->mailer->send($message);
    }
}
