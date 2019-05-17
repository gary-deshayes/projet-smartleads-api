<?php

namespace App\Controller;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\OperationSent;
use App\AdminBundle\Form\OperationSentType;
use App\AdminBundle\Entity\SettingsOperation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Entity\FormulaireOperation;
use App\AdminBundle\Form\ContactsOperationType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\AdminBundle\Entity\ContactOperation;

class OperationSentController extends AbstractController
{

    /**
     * @Route("/{idSalesperson}/edit", name="operation_sent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OperationSent $operationSent): Response
    {
        $form = $this->createForm(OperationSentType::class, $operationSent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operation_sent_index', [
                'idSalesperson' => $operationSent->getIdSalesperson(),
            ]);
        }

        return $this->render('operation_sent/edit.html.twig', [
            'operation_sent' => $operationSent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSalesperson}", name="operation_sent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OperationSent $operationSent): Response
    {
        if ($this->isCsrfTokenValid('delete' . $operationSent->getIdSalesperson(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operationSent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operation_sent_index');
    }

    /**
     * @Route("/operation/{name}/{uniqid}", name="operation_send_display", methods={"GET","POST"})
     */
    public function display(Request $request)
    {
        //Opération concernée
        $operation = $this->getDoctrine()
            ->getRepository(Operations::class)
            ->findOneBy(array("name" => $request->get("name")));

        //Ligne qui lit l'opération au contact etc
        $operationSent = $this->getDoctrine()
            ->getRepository(OperationSent::class)
            ->findOneBy(array("uniqIdContact" => $request->get("uniqid")));
        //Si l'opération existe
        if ($operation != null) {

            //Si l'opération n'est pas finie
            if ($operation->getClosingDate() >= new \DateTime()) {

                //Si le contact a déjà mis à jour on redirige vers une template déjà participé
                if ($operationSent->getState() != 3) {

                    $contact = $this->getDoctrine()->getRepository(Contacts::class)->findOneBy(array("code" => $operationSent->getContacts()));
                    if ($contact != null) {
                        //On mets à vu le concours
                        $operationSent->setState(2);
                        $this->getDoctrine()->getManager()->persist($operationSent);
                        $this->getDoctrine()->getManager()->flush();


                        //Récupération des options du formulaire
                        $formulaire_options = $this->getDoctrine()->getRepository(FormulaireOperation::class)->findOneBy(array("operation" => $operation->getCode()));
                        $settings_operation = $this->getDoctrine()->getRepository(SettingsOperation::class)->findOneBy(array("operation" => $operation));
                        $entreprise_contact = $this->getDoctrine()->getRepository(Company::class)->findOneBy(array("code" => $contact->getCompany()));
                        $contactOperation = new ContactOperation();

                        //On rempli la partie company
                        $contactOperation->setNameCompany($entreprise_contact->getName());
                        $contactOperation->setActivityArea($entreprise_contact->getActivityArea());
                        $contactOperation->setLegalStatus($entreprise_contact->getLegalStatus());
                        $contactOperation->setSiret($entreprise_contact->getSiret());
                        $contactOperation->setNumberEmployees($entreprise_contact->getNumberEmployees());
                        $contactOperation->setTurnovers($entreprise_contact->getTurnovers());
                        $contactOperation->setAddress($entreprise_contact->getAddress());
                        $contactOperation->setPostalCode($entreprise_contact->getPostalCode());
                        $contactOperation->setCountry($entreprise_contact->getCountry());
                        $contactOperation->setPhoneCompany($entreprise_contact->getPhone());
                        $contactOperation->setFax($entreprise_contact->getFax());
                        $contactOperation->setWebsite($entreprise_contact->getWebsite());
                        $contactOperation->setEmailCompany($entreprise_contact->getEmail());


                        //On rempli la partie contact
                        $contactOperation->setGender($contact->getGender());
                        $contactOperation->setFirstName($contact->getFirstName());
                        $contactOperation->setLastName($contact->getLastName());
                        $contactOperation->setBirthDate($contact->getBirthDate());
                        $contactOperation->setMobilePhone($contact->getMobilePhone());
                        $contactOperation->setPhone($contact->getPhone());
                        $contactOperation->setLinkedin($contact->getLinkedin());
                        $contactOperation->setFacebook($contact->getFacebook());
                        $contactOperation->setTwitter($contact->getTwitter());
                        $contactOperation->setEmailContact($contact->getEmail());
                        $contactOperation->setProfession($contact->getProfession());
                        $contactOperation->setWorkName($contact->getWorkname());


                        $form = $this->createForm(ContactsOperationType::class, $contactOperation);
                        $form->handleRequest($request);
                        if ($form->isSubmitted() && $form->isValid()) {

                            //On gère l'enregistrement des données du contact
                            if ($formulaire_options->getContacts_Gender() >= 2) {
                                $contact->setGender($contactOperation->getGender());
                            }
                            if ($formulaire_options->getContacts_Firstname() >= 2) {
                                $contact->setFirstname($contactOperation->getFirstName());
                            }
                            if ($formulaire_options->getContacts_Lastname() >= 2) {
                                $contact->setLastname($contactOperation->getLastName());
                            }
                            if ($formulaire_options->getContacts_Birthdate() >= 2) {
                                $contact->setBirthdate($contactOperation->getBirthdate());
                            }
                            if ($formulaire_options->getContacts_Mail_Pro() >= 2) {
                                $contact->setEmail($contactOperation->getEmailContact());
                            }
                            if ($formulaire_options->getContacts_Phone() >= 2) {
                                $contact->setPhone($contactOperation->getPhone());
                            }
                            if ($formulaire_options->getContacts_Mobile_Phone() >= 2) {
                                $contact->setMobilePhone($contactOperation->getMobilePhone());
                            }
                            if ($formulaire_options->getContacts_Facebook() >= 2) {
                                $contact->setFacebook($contactOperation->getFacebook());
                            }
                            if ($formulaire_options->getContacts_Linkedin() >= 2) {
                                $contact->setLinkedin($contactOperation->getLinkedin());
                            }
                            if ($formulaire_options->getContacts_Twitter() >= 2) {
                                $contact->setTwitter($contactOperation->getTwitter());
                            }
                            if ($formulaire_options->getContacts_Profession() >= 2) {
                                $contact->setProfession($contactOperation->getProfession());
                            }
                            if ($formulaire_options->getContacts_Workname() >= 2) {
                                $contact->setWorkname($contactOperation->getWorkName());
                            }


                            //On gère l'enregistrement des données de l'entreprise
                            if ($formulaire_options->getCompany_Name() >= 2) {
                                $entreprise_contact->setName($contactOperation->getNameCompany());
                            }
                            if ($formulaire_options->getCompany_Naf() >= 2) {
                                $entreprise_contact->setActivityArea($contactOperation->getActivityArea());
                            }
                            if ($formulaire_options->getCompany_Legal_Status() >= 2) {
                                $entreprise_contact->setIdLegalStatus($contactOperation->getLegalStatus());
                            }
                            if ($formulaire_options->getCompany_Siret() >= 2) {
                                $entreprise_contact->setSiret($contactOperation->getSiret());
                            }
                            if ($formulaire_options->getCompany_Number_Employees() >= 2) {
                                $entreprise_contact->setNumberEmployees($contactOperation->getNumberEmployees());
                            }
                            if ($formulaire_options->getCompany_Turnovers() >= 2) {
                                $entreprise_contact->setTurnovers($contactOperation->getTurnovers());
                            }
                            if ($formulaire_options->getCompany_Address() >= 2) {
                                $entreprise_contact->setAddress($contactOperation->getAddress());
                            }
                            if ($formulaire_options->getCompany_Postal_Code() >= 2) {
                                $entreprise_contact->setPostalCode($contactOperation->getPostalCode());
                            }
                            if ($formulaire_options->getCompany_Country() >= 2) {
                                $entreprise_contact->setCountry($contactOperation->getCountry());
                            }
                            if ($formulaire_options->getCompany_Standard_Phone() >= 2) {
                                $entreprise_contact->setPhone($contactOperation->getPhoneCompany());
                            }
                            if ($formulaire_options->getCompany_Fax() >= 2) {
                                $entreprise_contact->setFax($contactOperation->getFax());
                            }
                            if ($formulaire_options->getCompany_Website() >= 2) {
                                $entreprise_contact->setWebsite($contactOperation->getWebsite());
                            }
                            if ($formulaire_options->getCompany_Mail() >= 2) {
                                $entreprise_contact->setEmail($contactOperation->getEmailCompany());
                            }
                            $contact->setUpdatedAt(new \DateTime());
                            //On mets à mis à jour le concours
                            $operationSent->setState(3);
                            $this->getDoctrine()->getManager()->persist($operationSent);
                            $this->getDoctrine()->getManager()->flush();
                            return $this->render("template_operations/thanks.html.twig", ["operation" => $operation]);
                        }

                        return $this->render(
                            "template_operations/operation_commerciale.html.twig",
                            [
                                "contact" => $contact,
                                "operation" => $operation,
                                "formContact" => $form->createView(),
                                "formulaire_options" => $formulaire_options,
                                "settings_operation" => $settings_operation,
                                "company" => $entreprise_contact
                            ]
                        );
                    }
                } else {
                    return $this->render("template_operations/already_sent.html.twig", ["operation" => $operation,]);
                }
            } else {
                //Redirect opération finie
                return $this->render("template_operations/operation_finished.html.twig");
            }
        } else {
            //Redirect pas d'opération
            return $this->render("template_operations/operation_not_found.html.twig");
        }
    }

    /**
     * @Route("/operation/{name}/{uniqid}/refus", name="operation_send_refus", methods={"GET"})
     */
    public function refus(Request $request)
    {
        //Ligne qui lit l'opération au contact etc
        $operationSent = $this->getDoctrine()
            ->getRepository(OperationSent::class)
            ->findOneBy(array("uniqIdContact" => $request->get("uniqid")));
        if ($operationSent != null) {
            if ($operationSent->getState() == 5) {
                return $this->render("template_operations/already_rejected.html.twig");
            } else {
                $operationSent->setState(5);
                $this->getDoctrine()->getManager()->flush();
                return $this->render("template_operations/rejected_accepted.html.twig");
            }
        } else {
            return $this->render("template_operations/operation_not_found.html.twig");
        }
    }
}
