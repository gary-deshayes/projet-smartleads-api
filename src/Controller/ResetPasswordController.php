<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Entity\Salesperson;
use App\Form\EmailResetType;
use App\Form\ResetType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{   
    /**
     * @Route("/resetPassword", name="reset_password", methods={"GET","POST"})
     */
    public function resetPassword(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(EmailResetType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $salesperson = $entityManager->getRepository(Salesperson::class)->findOneByEmail($form->getData()['email']);
            if ($salesperson !== null) {
                $token = uniqid();
                $salesperson->setTokenResetPassword($token);
                $entityManager->persist($salesperson);
                $entityManager->flush();

                $message = (new \Swift_Message('Mot de passe oublié ?'))
                ->setFrom('smartleads.supp@outlook.com')
                ->setTo('lucas.vignijr@gmail.com')
                ->setBody(
                $this->renderView(
                'reset_password/template.html.twig', 
                    [
                        "name" => $salesperson->getLastName(),
                        "firstName" => $salesperson->getFirstName(),
                        "link" => "/resetPassword/" . $salesperson->getLastName() . "/" . $token,
                    ]
                ),
            'text/html'
            );
                $this->get('mailer')->send($message);
                return $this->render('reset_password/template.html.twig', array(
                    "link" => "/resetPassword/" . $salesperson->getLastName() . "/" . $token,
                    'name' => $salesperson->getLastName(),
                    'firstName' => $salesperson->getFirstName(),
                    'salesperson' => $salesperson
            ));
            }
        }

        return $this->render('reset_password/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/resetPassword/{name}/{token}", name="reset_password_token", methods={"GET","POST"})
     */
    public function resetPasswordToken(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {   
        $token = $request->get("token");
       
        if ($token !== null) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(Salesperson::class)->findOneByTokenResetPassword($token);
            if ($user !== null) {
                $form = $this->createForm(ResetType::class);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $plainPassword = $form->getData()['password'];
                    dump($plainPassword);
                    $encoded = $encoder->encodePassword($user, $plainPassword);
                    $user->setPassword($encoded);
                    $entityManager->persist($user);
                    $entityManager->flush();

                    //add flash

                    return $this->redirectToRoute('app_login');
                }

                return $this->render('reset_password/reset_password_token.html.twig', array(
                    'form' => $form->createView(),
                ));       
            }
            throw $this->createNotFoundException('Désolé vous n\'etes pas reconnue, veuillez recommencer le procéder de rénitialisation du mot de passe');
        }
        throw $this->createNotFoundException('Désolé vous n\'etes pas reconnue, veuillez recommencer le procéder de rénitialisation du mot de passe');
    }

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
