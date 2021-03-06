<?php

namespace App\AdminBundle\Controller;

use Faker;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Country;
use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Form\SearchType;
use App\AdminBundle\Entity\Turnovers;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\Profession;
use App\AdminBundle\Entity\Salesperson;
use App\AdminBundle\Entity\ActivityArea;
use App\AdminBundle\Entity\AffectedArea;
use App\AdminBundle\EntitySearch\Search;
use App\AdminBundle\Form\OperationsType;
use App\AdminBundle\Entity\CompanyStatus;
use App\AdminBundle\Entity\OperationSent;
use App\AdminBundle\Entity\DecisionMaking;
use App\AdminBundle\Service\MailerService;
use App\AdminBundle\Entity\NumberEmployees;
use App\AdminBundle\Entity\TargetOperation;
use Knp\Component\Pager\PaginatorInterface;
use App\AdminBundle\Entity\SettingsOperation;
use App\AdminBundle\Form\TargetOperationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Entity\FormulaireOperation;
use App\AdminBundle\Form\SettingsOperationType;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Form\FormulaireOperationType;
use App\AdminBundle\Repository\SettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/operations")
 */
class OperationsController extends AbstractController
{
    
    private $settingsApplication;

    public function __construct(SettingsRepository $settingsRepo)
    {
        $this->settingsApplication = $settingsRepo
        ->findOneBy(array("id" => "1"));
    }

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
            "settingsApplication" => $this->settingsApplication
        ]);
    }

    /**
     * @Route("/new", name="operations_new", methods={"GET","POST"})
     */
    function new(Request $request): Response
    {
        $repoOperation = $this->getDoctrine()->getRepository(Operations::class);
        $this->faker = Faker\Factory::create('fr_FR');
        $operation = new Operations();
        $form = $this->createForm(OperationsType::class, $operation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->get("operation");
            do {
                $code = $this->faker->regexify("[A-Z]{10}");
            } while ($repoOperation->findOneBy(array("code" => $code)) != null);
            $operation->setCode($code);
            $operation->setCreated_At(new \DateTime());
            $operation->setSent(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($operation);
            $entityManager->flush();

            return $this->redirectToRoute('operations_index');
        }

        return $this->render('operations/new.html.twig', [
            'operation' => $operation,
            'form' => $form->createView(),
            "settingsApplication" => $this->settingsApplication
        ]);
    }

    /**
     * @Route("/{code}/edit", name="operations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Operations $operation): Response
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

        //Partie ciblage
        $targetOperation = new TargetOperation();
        $formTargetOperation = $this->createForm(TargetOperationType::class, $targetOperation, [
            'action' => $this->generateUrl('target_operation_sauvegarde_target'),
        ]);

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
        $operationSettings = new SettingsOperation();
        if ($operation->getSettings() != null) {
            $operationSettings = $operation->getSettings();
        } else {
            $operationSettings = new SettingsOperation();
        }
        $formSettings = $this->createForm(SettingsOperationType::class, $operationSettings);
        $formSettings->handleRequest($request);
        if ($formSettings->isSubmitted() && $formSettings->isValid()) {

            $operation->setSettings($operationSettings);
            $operation->setUser_last_update($this->getUser());
            $operationSettings->setOperation($operation);
            $this->getDoctrine()->getManager()->persist($operationSettings);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operations_edit', [
                'code' => $operation->getCode(),
            ]);
        }

        //Récupération des ciblages

        $ciblages = $this->getDoctrine()->getRepository(TargetOperation::class)->findBy(array("operation" => $operation->getCode()));
        //La méthode fais le tri des cibles
        $contactsCiblesSansDoublons = self::recuperationCiblages($ciblages);

        //Récupération des résultats
        $operationsSents = $this->getDoctrine()->getRepository(OperationSent::class)->findBy(array("operation" => $operation));
        //Calcul des pourcentage résultats
        $pourcentage["nonouvert"] = "";
        $pourcentage["ouvert"] = "";
        $pourcentage["qualifier"] = "";
        $pourcentage["refus"] = "";
        $pourcentage["desabonnement"] = "";
        if (count($operationsSents) > 0) {
            $nombre["non-ouvert"] = 0;
            $nombre["ouvert"] = 0;
            $nombre["qualifier"] = 0;
            $nombre["refus"] = 0;
            $nombre["desabonnement"] = 0;
            foreach ($operationsSents as $opeSent) {
                switch ($opeSent->getState()) {
                    case 1:
                        $nombre["non-ouvert"]++;
                        break;
                    case 2:
                        $nombre["ouvert"]++;
                        break;
                    case 3:
                        $nombre["qualifier"]++;
                        break;
                    case 5:
                        $nombre["refus"]++;
                        break;
                    case 4:
                        $nombre["desabonnement"]++;
                        break;
                }
            }
            $pourcentage["nonouvert"] = round((100 * $nombre["non-ouvert"]) / count($operationsSents));
            $pourcentage["ouvert"] = round((100 * $nombre["ouvert"]) / count($operationsSents));
            $pourcentage["qualifier"] = round((100 * $nombre["qualifier"]) / count($operationsSents));
            $pourcentage["refus"] = round((100 * $nombre["refus"]) / count($operationsSents));
            $pourcentage["desabonnement"] = round((100 * $nombre["desabonnement"]) / count($operationsSents));
        }
        return $this->render('operations/edit.html.twig', [
            'operation' => $operation,
            'form' => $form->createView(),
            "formulaireOperation" => $formFormulaireOperation->createView(),
            "formulaire_operation" => $formulaire_operation,
            "settings_operation" => $operationSettings,
            "formSettings" => $formSettings->createView(),
            "formTargetOperation" => $formTargetOperation->createView(),
            "contacts_cibles" => $contactsCiblesSansDoublons,
            "ciblages" => $ciblages,
            "resultats_operation" => $operationsSents,
            "pourcentage" => $pourcentage,
            "settingsApplication" => $this->settingsApplication
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

    /**
     * @Route("/selectDynamique/{entity}", name="target_operation_select_dynamique", methods={"GET"})
     */
    public function selectDynamique($entity)
    {
        $result = $this->getDoctrine()->getRepository("AdminBundle:" . $entity)->findBy(array(), array("libelle" => "ASC"));

        $data = array();
        if ($entity == "Country") {
            foreach ($result as $res) {
                $jsonData = array(
                    "code" => $res->getCode(),
                    "libelle" => $res->getLibelle(),
                );

                array_push($data, $jsonData);
            }
        } else {
            foreach ($result as $res) {
                $jsonData = array(
                    "id" => $res->getId(),
                    "libelle" => $res->getLibelle(),
                );

                array_push($data, $jsonData);
            }
        }

        $dataJson = [
            "entité" => $entity,
            "data" => $data,
            "retour" => "-1",
        ];
        $response = new Response(json_encode($dataJson), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/sauvegarde_target", name="target_operation_sauvegarde_target", methods={"POST"})
     */
    public function sauvegardeTarget(Request $request)
    {
        $arrayTarget = $request->get('target_operation');
        $targetOperation = new TargetOperation();

        $operation = $this->getDoctrine()->getRepository(Operations::class)->findOneBy(array("code" => $arrayTarget["operation"]));
        $value = "";
        $type = 0;
        if (!isset($arrayTarget["input"])) {
            $type = 1;
            $value = $arrayTarget["select"];
        } else {
            $type = 2;
            $value = $arrayTarget["input"];
        }
        $targetOperationExist = $this->getDoctrine()->getRepository(TargetOperation::class)->findOneBy(array(
            "entity" => $arrayTarget["entity"],
            "parameter" => $arrayTarget["parameter"],
            "value" => $value,
        ));
        if (!isset($targetOperationExist)) {
            $targetOperation->setSend(0);
            $targetOperation->setType_value($type);
            if ($type == 1) {
                switch ($arrayTarget["parameter"]) {
                    case "NumberEmployees":
                        $nbEmployee = $this->getDoctrine()->getRepository(NumberEmployees::class)->findOneBy(array("id" => $value));
                        $targetOperation->setValue_entity($nbEmployee->getLibelle());
                        break;
                    case "CompanyStatus":
                        $companyStatus = $this->getDoctrine()->getRepository(CompanyStatus::class)->findOneBy(array("id" => $value));
                        $targetOperation->setValue_entity($companyStatus->getLibelle());
                        break;
                    case "Country":
                        $country = $this->getDoctrine()->getRepository(Country::class)->findOneBy(array("code" => $value));
                        $targetOperation->setValue_entity($country->getLibelle());
                        break;
                    case "ActivityArea":
                        $activityArea = $this->getDoctrine()->getRepository(ActivityArea::class)->findOneBy(array("id" => $value));
                        $targetOperation->setValue_entity($activityArea->getLibelle());

                        break;
                    case "Turnovers":
                        $turnovers = $this->getDoctrine()->getRepository(Turnovers::class)->findOneBy(array("id" => $value));
                        $targetOperation->setValue_entity($turnovers->getLibelle());

                        break;
                    case "AffectedArea":
                        $affectedArea = $this->getDoctrine()->getRepository(AffectedArea::class)->findOneBy(array("id" => $value));
                        $targetOperation->setValue_entity($affectedArea->getLibelle());

                        break;
                    case "Profession":
                        $profession = $this->getDoctrine()->getRepository(Profession::class)->findOneBy(array("id" => $value));
                        $targetOperation->setValue_entity($profession->getLibelle());

                        break;
                    case "DecisionMaking":
                        $decisionMaking = $this->getDoctrine()->getRepository(DecisionMaking::class)->findOneBy(array("id" => $value));
                        $targetOperation->setValue_entity($decisionMaking->getLibelle());
                    case "RolesSalesperson":
                        if ($value == "ROLE_DIRECTEUR") {
                            $targetOperation->setValue_entity("Directeur");
                        } elseif ($value == "ROLE_RESPONSABLE") {
                            $targetOperation->setValue_entity("Responsable");
                        } elseif ($value == "ROLE_COMMERCIAL") {
                            $targetOperation->setValue_entity("Commercial");
                        }
                        break;
                }
            }

            $targetOperation->setOperation($operation);
            $targetOperation->setEntity($arrayTarget["entity"]);
            $targetOperation->setParameter($arrayTarget["parameter"]);
            $targetOperation->setValue($value);

            $em = $this->getDoctrine()->getManager();
            $em->persist($targetOperation);
            $em->flush();
        }

        $ciblages = $this->getDoctrine()->getRepository(TargetOperation::class)->findBy(array("operation" => $operation->getCode()));
        //La méthode fais le tri des cibles
        $contactsCiblesSansDoublons = self::recuperationCiblages($ciblages);

        $data = [
            "target" => [
                "id" => $targetOperation->getId(),
                "entity" => $targetOperation->getEntity(),
                "parameter" => $targetOperation->getParameter(),
                "type_value" => $targetOperation->getType_Value(),
                "value"  => $targetOperation->getValue(),
                "value_entity" => $targetOperation->getValue_Entity(),
            ],
            "contacts_cibles" => count($contactsCiblesSansDoublons),
            "ciblages" => count($ciblages)
        ];
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/delete_target/{id}", name="target_operation_delete_target", methods={"POST"})
     */
    public function deleteTarget(Request $request, TargetOperation $target)
    {
        $operation = $target->getOperation();
        $this->getDoctrine()->getManager()->remove($target);
        $this->getDoctrine()->getManager()->flush();
        $ciblages = $this->getDoctrine()->getRepository(TargetOperation::class)->findBy(array("operation" => $operation->getCode()));
        //La méthode fais le tri des cibles
        $contactsCiblesSansDoublons = self::recuperationCiblages($ciblages);
        $data = [
            "retour" => "1",
            "contacts_cibles" => count($contactsCiblesSansDoublons),
            "ciblages" => count($ciblages),
        ];
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function recuperationCiblages($ciblages)
    {
        //Récupération des contacts pour chaque cibles
        $contactsCibles = array();
        $repoContacts = $this->getDoctrine()->getRepository(Contacts::class);
        foreach ($ciblages as $cible) {
            //Ciblage par entreprises
            if ($cible->getEntity() == "Company") {
                $repoCompany = $this->getDoctrine()->getRepository(Company::class);
                switch ($cible->getParameter()) {
                    case "postalCode":
                        $idCompany = $repoCompany->getIdCompanyBy("company.postalCode", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereCompanyInArray($idCompany);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }
                        break;
                    case "NumberEmployees":
                        $idCompany = $repoCompany->getIdCompanyBy("company.numberEmployees", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereCompanyInArray($idCompany);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                    case "CompanyStatus":
                        $idCompany = $repoCompany->getIdCompanyBy("company.companyStatus", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereCompanyInArray($idCompany);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                    case "Country":
                        $idCompany = $repoCompany->getIdCompanyBy("company.country", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereCompanyInArray($idCompany);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }
                        break;
                    case "ActivityArea":
                        $idCompany = $repoCompany->getIdCompanyBy("company.activityArea", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereCompanyInArray($idCompany);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                    case "Turnovers":
                        $idCompany = $repoCompany->getIdCompanyBy("company.turnovers", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereCompanyInArray($idCompany);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                    case "CodeCompany":
                        $contacts = $repoContacts->getContactsWhereCompanyInArray($cible->getValue());
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                    case "NameCompany":
                        $idCompany = $repoCompany->getIdCompanyBy("company.name", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereCompanyInArray($idCompany);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;

                    case "Town":
                        $idCompany = $repoCompany->getIdCompanyBy("company.town", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereCompanyInArray($idCompany);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                }
                //Ciblage par contacts
            } else if ($cible->getEntity() == "Contacts") {
                switch ($cible->getParameter()) {
                    case "Profession":
                        $contacts = $repoContacts->getContactsBy("contacts.profession", $cible->getValue());
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                    case "DecisionMaking":
                        $contacts = $repoContacts->getContactsBy("contacts.decision_making", $cible->getValue());
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                }
                //Ciblage par commerciaux
            } else if ($cible->getEntity() == "Salesperson") {
                $repoSalesperson = $this->getDoctrine()->getRepository(Salesperson::class);
                switch ($cible->getParameter()) {
                    case "AffectedArea":
                        $salespersonsCodes = $repoSalesperson->getCodeSalespersonBy("salesperson.affectedArea", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereSalespersonInArray($salespersonsCodes);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                    case "NameSalesperson":
                        $salespersonsCodes = $repoSalesperson->getCodeSalespersonBy("NameSalesperson", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereSalespersonInArray($salespersonsCodes);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                    case "RolesSalesperson":
                        $salespersonsCodes = $repoSalesperson->getCodeSalespersonBy("RolesSalesperson", $cible->getValue());
                        $contacts = $repoContacts->getContactsWhereSalespersonInArray($salespersonsCodes);
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                    case "CodeSalesperson":
                        $contacts = $repoContacts->getContactsWhereSalespersonInArray($cible->getValue());
                        foreach ($contacts as $contact) {
                            array_push($contactsCibles, $contact);
                        }

                        break;
                }
            }
        }
        //On retire tout les contacts qui ne sont pas opt in
        foreach ($contactsCibles as $key => $contacts) {
            if ($contacts->getOptInOffresCommercial() == false) {
                unset($contactsCibles[$key]);
            }
        }
        $contactsCiblesSansDoublons = array_unique($contactsCibles);

        return $contactsCiblesSansDoublons;
    }

    /**
     * @Route("/envoi_operation/{code}", name="envoi_operation", methods={"GET"})
     */
    public function envoi_operation(Operations $operation, MailerService $mailer)
    {
        $em = $this->getDoctrine()->getManager();
        $ciblages = $this->getDoctrine()->getRepository(TargetOperation::class)->findBy(array("operation" => $operation->getCode()));
        //La méthode fais le tri des cibles
        $contactsCiblesSansDoublons = self::recuperationCiblages($ciblages);
        $author = $operation->getAuthor();
        $settings_operation = $this->getDoctrine()->getRepository(SettingsOperation::class)->findOneBy(array("operation" => $operation->getCode()));
        foreach ($contactsCiblesSansDoublons as $contact) {
            $uniqid = md5(uniqid(rand(), true));
            $dataReturn = $mailer->send_operation($operation, $contact, $settings_operation, $uniqid);
            // $mailer->send_operation_swift($operation, $contact, $settings_operation, $uniqid);
            $messageID = $dataReturn["messageID"];
            $operationSent = new OperationSent();
            $operationSent->setMessageID($messageID);
            $operationSent->setOperation($operation);
            $operationSent->setSalesperson($author);
            $operationSent->setContacts($contact);
            $operationSent->setUniqIdContact($uniqid);
            $operationSent->setSentAt(new \DateTime());
            //On mets l'état à 1 qui signifie envoyé
            $operationSent->setState(1);
            $em->persist($operationSent);
        }
        //On déclare l'opération envoyé il ne sera plus possible de l'envoyer
        $operation->setSent(true);
        $em->flush();

        return $this->redirectToRoute('operations_edit', [
            'code' => $operation->getCode(),
        ]);
    }
}
