<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Form\SearchType;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\EntitySearch\Search;
use App\AdminBundle\Form\OperationsType;
use App\AdminBundle\Entity\OperationSent;
use Knp\Component\Pager\PaginatorInterface;
use App\AdminBundle\Entity\SettingsOperation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Entity\FormulaireOperation;
use App\AdminBundle\Form\SettingsOperationType;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Form\FormulaireOperationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/operations")
 */
class OperationsController extends AbstractController
{
    /**
     * @Route("/", name="operations_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $search = new Search();

        if ($search->getLimit() == null) {
            $search->setLimit(10);
        }

        $formSearch = $this->createForm(SearchType::class, $search);

        $formSearch->handleRequest($request);

        $queryOperations = $this->getDoctrine()
            ->getRepository(Operations::class)
            ->getOperations($search);

        $operations = $paginator->paginate(
            $queryOperations,
            $request->query->getInt('page', 1, $search->getLimit()),
            $search->getLimit()
        );

        $nbOperations = $this->getDoctrine()
            ->getRepository(Operations::class)
            ->getCountAllOperations($search);

        return $this->render('operations/index.html.twig', [
            'operations' => $operations,
            "nbOperations" => $nbOperations,
            'formsearch' => $formSearch->createView(),
        ]);
    }

    /**
     * @Route("/new", name="operations_new", methods={"GET","POST"})
     */
    function new (Request $request): Response {
        $operation = new Operations();
        $form = $this->createForm(OperationsType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($operation);
            $entityManager->flush();

            return $this->redirectToRoute('operations_index');
        }

        return $this->render('operations/new.html.twig', [
            'operation' => $operation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{code}/edit", name="operations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Operations $operation, \Swift_Mailer $mailer): Response
    {

        //On crée le formulaire pour FormulaireOpération
        if ($operation->getFormulaire_operation() != null) {

            $formulaire_operation = $this->getDoctrine()
                ->getRepository(FormulaireOperation::class)
                ->findOneBy(array("id" => $operation->getFormulaire_operation()->getId()));

        } else {
            $formulaire_operation = new FormulaireOperation();
        }
        $formFormulaireOperation = $this->createForm(FormulaireOperationType::class);
        $formFormulaireOperation->handleRequest($request);

        //Permet de gérer les valeurs du formulaire de l'opération
        if ($formFormulaireOperation->isSubmitted() && $formFormulaireOperation->isValid()) {
            $formulaire_operation->setOperation($operation);
            $operation->setFormulaire_operation($formulaire_operation);

            $tableauCheckbox = $request->get("formulaire_operation");
            if (array_key_exists("contacts_gender", $tableauCheckbox)) {
                $formulaire_operation->setContactsGender(count($tableauCheckbox["contacts_gender"]));
            } else {
                $formulaire_operation->setContactsGender(0);
            }
            if (array_key_exists("contacts_firstname", $tableauCheckbox)) {
                $formulaire_operation->setContactsFirstname(count($tableauCheckbox["contacts_firstname"]));
            } else {
                $formulaire_operation->setContactsFirstname(0);
            }
            if (array_key_exists("contacts_lastname", $tableauCheckbox)) {
                $formulaire_operation->setContactsLastname(count($tableauCheckbox["contacts_lastname"]));
            } else {
                $formulaire_operation->setContactsLastname(0);
            }
            if (array_key_exists("contacts_birthdate", $tableauCheckbox)) {
                $formulaire_operation->setContactsBirthdate(count($tableauCheckbox["contacts_birthdate"]));
            } else {
                $formulaire_operation->setContactsBirthdate(0);
            }
            if (array_key_exists("contacts_mail_pro", $tableauCheckbox)) {
                $formulaire_operation->setContactsMailPro(count($tableauCheckbox["contacts_mail_pro"]));
            } else {
                $formulaire_operation->setContactsMailPro(0);
            }
            if (array_key_exists("contacts_mobile_phone", $tableauCheckbox)) {
                $formulaire_operation->setContactsMobilePhone(count($tableauCheckbox["contacts_mobile_phone"]));
            } else {
                $formulaire_operation->setContactsMobilePhone(0);
            }
            if (array_key_exists("contacts_phone", $tableauCheckbox)) {
                $formulaire_operation->setContactsPhone(count($tableauCheckbox["contacts_phone"]));
            } else {
                $formulaire_operation->setContactsPhone(0);
            }
            if (array_key_exists("contacts_linkedin", $tableauCheckbox)) {
                $formulaire_operation->setContactsLinkedin(count($tableauCheckbox["contacts_linkedin"]));
            } else {
                $formulaire_operation->setContactsLinkedin(0);
            }
            if (array_key_exists("contacts_twitter", $tableauCheckbox)) {
                $formulaire_operation->setContactsTwitter(count($tableauCheckbox["contacts_twitter"]));
            } else {
                $formulaire_operation->setContactsTwitter(0);
            }
            if (array_key_exists("contacts_facebook", $tableauCheckbox)) {
                $formulaire_operation->setContactsFacebook(count($tableauCheckbox["contacts_facebook"]));
            } else {
                $formulaire_operation->setContactsFacebook(0);
            }
            if (array_key_exists("contacts_profession", $tableauCheckbox)) {
                $formulaire_operation->setContactsProfession(count($tableauCheckbox["contacts_profession"]));
            } else {
                $formulaire_operation->setContactsProfession(0);
            }
            if (array_key_exists("contacts_workname", $tableauCheckbox)) {
                $formulaire_operation->setContactsWorkname(count($tableauCheckbox["contacts_workname"]));
            } else {
                $formulaire_operation->setContactsWorkname(0);
            }
            if (array_key_exists("company_name", $tableauCheckbox)) {
                $formulaire_operation->setCompanyName(count($tableauCheckbox["company_name"]));
            } else {
                $formulaire_operation->setCompanyName(0);
            }
            if (array_key_exists("company_naf", $tableauCheckbox)) {
                $formulaire_operation->setCompanyNaf(count($tableauCheckbox["company_naf"]));
            } else {
                $formulaire_operation->setCompanyNaf(0);
            }
            if (array_key_exists("company_legal_status", $tableauCheckbox)) {
                $formulaire_operation->setCompanyLegalStatus(count($tableauCheckbox["company_legal_status"]));
            } else {
                $formulaire_operation->setCompanyLegalStatus(0);
            }
            if (array_key_exists("company_siret", $tableauCheckbox)) {
                $formulaire_operation->setCompanySiret(count($tableauCheckbox["company_siret"]));
            } else {
                $formulaire_operation->setCompanySiret(0);
            }
            if (array_key_exists("company_number_employees", $tableauCheckbox)) {
                $formulaire_operation->setCompanyNumberEmployees(count($tableauCheckbox["company_number_employees"]));
            } else {
                $formulaire_operation->setCompanyNumberEmployees(0);
            }
            if (array_key_exists("company_turnovers", $tableauCheckbox)) {
                $formulaire_operation->setCompanyTurnovers(count($tableauCheckbox["company_turnovers"]));
            } else {
                $formulaire_operation->setCompanyTurnovers(0);
            }
            if (array_key_exists("company_address", $tableauCheckbox)) {
                $formulaire_operation->setCompanyAddress(count($tableauCheckbox["company_address"]));
            } else {
                $formulaire_operation->setCompanyAddress(0);
            }
            if (array_key_exists("company_postal_code", $tableauCheckbox)) {
                $formulaire_operation->setCompanyPostalCode(count($tableauCheckbox["company_postal_code"]));
            } else {
                $formulaire_operation->setCompanyPostalCode(0);
            }
            if (array_key_exists("company_country", $tableauCheckbox)) {
                $formulaire_operation->setCompanyCountry(count($tableauCheckbox["company_country"]));
            } else {
                $formulaire_operation->setCompanyCountry(0);
            }
            if (array_key_exists("company_standard_phone", $tableauCheckbox)) {
                $formulaire_operation->setCompanyStandardPhone(count($tableauCheckbox["company_standard_phone"]));
            } else {
                $formulaire_operation->setCompanyStandardPhone(0);
            }
            if (array_key_exists("company_fax", $tableauCheckbox)) {
                $formulaire_operation->setCompanyFax(count($tableauCheckbox["company_fax"]));
            } else {
                $formulaire_operation->setCompanyFax(0);
            }
            if (array_key_exists("company_website", $tableauCheckbox)) {
                $formulaire_operation->setCompanyWebsite(count($tableauCheckbox["company_website"]));
            } else {
                $formulaire_operation->setCompanyWebsite(0);
            }
            if (array_key_exists("company_mail", $tableauCheckbox)) {
                $formulaire_operation->setCompanyMail(count($tableauCheckbox["company_mail"]));
            } else {
                $formulaire_operation->setCompanyMail(0);
            }
            $this->getDoctrine()->getManager()->persist($formulaire_operation);
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('operations_edit', [
                'code' => $operation->getCode(),
            ]);

        }

        //On récupère le nombre de contacts qui ont reçu l'opération
        $nbContactOperation = $this->getDoctrine()
            ->getRepository(OperationSent::class)
            ->getNbContactsOperation($operation->getCode());

        //On récupère le nombre de personne qui ont vu l'opération
        $nbLuOperation = $this->getDoctrine()
            ->getRepository(OperationSent::class)
            ->getNbLu($operation->getCode());

        //On récupère le nombre de personne qui non pas ouvert l'opération
        $nbNonOuvert = $this->getDoctrine()
            ->getRepository(OperationSent::class)
            ->getNbNonOuvert($operation->getCode());

        //On récupère le nombre de personne qui ont mis à jour leurs infos
        $nbMaj = $this->getDoctrine()
            ->getRepository(OperationSent::class)
            ->getNbMAJ($operation->getCode());

        //On ne récupere que les id des contacts qui ont déjà reçu l'opération
        $idContacts = $this->getDoctrine()
            ->getRepository(OperationSent::class)
            ->getCodeContactsOperation($operation->getCode());

        //Contacts à selectionné
        if ($idContacts == null) {
            $contacts = $this->getDoctrine()
                ->getRepository(Contacts::class)
                ->findBy(array(), array('lastName' => 'ASC'));
        } else {
            $contacts = $this->getDoctrine()
                ->getRepository(Contacts::class)
                ->getContactsOperationNotSend($idContacts);
        }

        $defaultData = ['message' => 'Form sans entité'];

        // Formulaire des contacts qui recevront l'opération
        $formAddContacts = $this->createFormBuilder($defaultData)
            ->add('contacts', EntityType::class, [
                'class' => Contacts::class,
                // 'choices' => $contacts,
                "multiple" => true,
                "expanded" => true,
            ])
            ->add("operation", HiddenType::class, [
                'data' => $operation->getCode(),
            ])
            ->getForm();

        $formAddContacts->handleRequest($request);

        //Envoi des mails et procédure d'opérations
        if ($formAddContacts->isSubmitted()) {

            //Operation envoyée
            $operation = $this->getDoctrine()
                ->getRepository(Operations::class)
                ->findOneBy(array("code" => $request->get("form")["operation"]));
            $author = $operation->getAuthor();
            $em = $this->getDoctrine()->getManager();

            //Récuperation des contacts ciblés
            $contactsCible = $this->getDoctrine()
                ->getRepository(Contacts::class)
                ->getContactsInArray($request->get("form")["contacts"]);
            //Pour chaque contacts on insère son envoi dans la base et lui envoi un mail
            foreach ($contactsCible as $contact) {
                $uniqid = \uniqid();
                $operationSent = new OperationSent();
                $operationSent->setOperation($operation);
                $operationSent->setSalesperson($author);
                $operationSent->setContacts($contact);
                $operationSent->setUniqIdContact($uniqid);
                $operationSent->setSentAt(new \DateTime());
                $operationSent->setState(1);
                $em->persist($operationSent);

                $message = (new \Swift_Message($operation->getMailObject()))
                    ->setFrom('smartleads.supp@outlook.com')

                    ->setTo($contact->getEmail())
                    ->setBody(
                        $this->renderView(
                            'operations/mail_view.html.twig',
                            [
                                "name" => $contact->__toString(),
                                "link" => $_SERVER["HTTP_ORIGIN"] . "/operation/" . $operation->getName() . "/" . $uniqid,
                            ]
                        ),
                        'text/html'
                    );
                $mailer->send($message);
            }
            $em->flush();
            return $this->redirectToRoute('operations_index');
        }

        //Formulaire d'édition de l'opération
        $form = $this->createForm(OperationsType::class, $operation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $operation->setUser_last_update($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operations_edit', [
                'code' => $operation->getCode(),
            ]);
        }
        $operationSettings;
        if($operation->getSettings() != null){
            $operationSettings = $operation->getSettings();
        } else {
            $operationSettings = new SettingsOperation();
        }
        $formSettings = $this->createForm(SettingsOperationType::class, $operationSettings);
        $formSettings->handleRequest($request);
        if($formSettings->isSubmitted() && $formSettings->isValid()){
            
            $operation->setSettings($operationSettings);
            $operation->setUser_last_update($this->getUser());
            $operationSettings->setOperation($operation);
            $this->getDoctrine()->getManager()->persist($operationSettings);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operations_edit', [
                'code' => $operation->getCode(),
            ]);
        }
            
        return $this->render('operations/edit.html.twig', [
            'operation' => $operation,
            'form' => $form->createView(),
            'contacts' => $contacts,
            'formAddContacts' => $formAddContacts->createView(),
            'nbRecu' => $nbContactOperation["nombre"],
            'nbOuvert' => $nbLuOperation["nombre"],
            'nbMaj' => $nbMaj["nombre"],
            'nbNonOuvert' => $nbNonOuvert["nombre"],
            "formulaireOperation" => $formFormulaireOperation->createView(),
            "formulaire_operation" => $formulaire_operation,
            "settings_operation" => $operationSettings,
            "formSettings" => $formSettings->createView()
        ]);
    }

    /**
     * @Route("/{name}", name="operations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Operations $operation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $operation->getName(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operations_index');
    }
}
