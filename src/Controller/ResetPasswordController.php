<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{
    /**
     * @Route("/sendMail", name="send_mail")
     */
    public function sendMail()
    {

    $message = (new \Swift_Message('Hello Email'))
        ->setFrom('smartleads.supp@outlook.com')
        ->setTo('lucas.vignijr@gmail.com')
        ->setBody(
            $this->renderView(
                'reset_password/index.html.twig'
            ),
            'text/html'
        );
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'emails/registration.txt.twig',
                ['name' => $name]
            ),
            'text/plain'
        )
        */
        
        // $mailer->send($message);
        $this->get('mailer')->send($message);
    
    return $this->render('reset_password/index.html.twig');
}
}
