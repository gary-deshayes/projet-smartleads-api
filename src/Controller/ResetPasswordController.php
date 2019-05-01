<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Entity\Salesperson;
use App\Form\EmailResetType;
use App\Form\PasswordResetType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\AdminBundle\Service\MailerService;

class ResetPasswordController extends AbstractController
{   
    /**
     * @Route("/resetPassword", name="reset_password", methods={"GET","POST"})
     */
    public function resetPassword(Request $request, MailerService $mailer)
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
                
                //Appelle send() dans le service dédié à l'envoie de mail
                $mailer->send($salesperson, $token);

<<<<<<< HEAD
                //Affichage du template de mail si l'envoie est effectué
=======
                $message = (new \Swift_Message('Mot de passe oublié ?'))
                ->setFrom('smartleads.supp@outlook.com')
                ->setTo('maxime.duroyonJR@gmail.com')
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
>>>>>>> finition_l
                return $this->render('reset_password/template.html.twig', array(
                    "link" => "/resetPasswordToken/" . $salesperson->getLastName() . "/" . $token,
                    'name' => $salesperson->getLastName(),
                    'firstName' => $salesperson->getFirstName(),
                    'salesperson' => $salesperson
                ));
            }
        }

        return $this->render('reset_password/email_for_password.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/resetPasswordToken/{name}/{token}", name="reset_password_token", methods={"GET","POST"})
     */
    public function resetPasswordToken(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {   
        $token = $request->get('token');
        if ($token !== null) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(Salesperson::class)->findOneByTokenResetPassword($token);
            if ($user !== null) {
                $form = $this->createForm(PasswordResetType::class);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $plainPassword = $form->getData(['password']);
                    $encoded = $passwordEncoder->encodePassword($user, $plainPassword["password"]);
                    $user->setPassword($encoded);
                    $user->setTokenResetPassword("");
                    $entityManager->persist($user);
                    $entityManager->flush();

                    //add flash

                    return $this->redirectToRoute('app_login');      
                }

                return $this->render('reset_password/reset_password.html.twig', array(
                    'form' => $form->createView(),
                ));       
            }
            throw $this->createNotFoundException('Désolé vous n\'etes pas reconnue, veuillez recommencer le procéder de rénitialisation du mot de passe');
        }
        throw $this->createNotFoundException('Désolé vous n\'etes pas reconnue, veuillez recommencer le procéder de rénitialisation du mot de passe');
    }

}
