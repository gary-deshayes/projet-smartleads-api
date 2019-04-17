<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\EntitySearch\Search;
use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\OperationSent;
use App\AdminBundle\Form\OperationsType;
use App\AdminBundle\Form\SearchType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Form\FormulaireOperationType;

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

        $formFormulaireOperation = $this->createForm(FormulaireOperationType::class);
        dump($formFormulaireOperation);
        $formFormulaireOperation->handleRequest($request);
        if ($formFormulaireOperation->isSubmitted() && $formFormulaireOperation->isValid()) {
            // $operation->setUser_last_update($this->getUser());
            // $this->getDoctrine()->getManager()->flush();

            // return $this->redirectToRoute('operations_index', [
            //     'code' => $operation->getCode(),
            // ]);
                dump($request);
            die("ici");
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
        $nbNonOuvert  = $this->getDoctrine()
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

            return $this->redirectToRoute('operations_index', [
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
            "formulaireOperation" => $formFormulaireOperation->createView()
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
