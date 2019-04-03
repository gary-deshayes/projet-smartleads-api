<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Form\SearchType;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\EntitySearch\Search;
use App\AdminBundle\Form\OperationsType;
use App\AdminBundle\Entity\OperationSent;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function edit(Request $request, Operations $operation): Response
    {

        $contacts = $this->getDoctrine()
            ->getRepository(Contacts::class)
            ->findBy(array(), array('lastName' => 'ASC'));

        $defaultData = ['message' => 'Form sans entité'];

        // Formulaire des contacts qui recevront l'opération
        $formAddContacts = $this->createFormBuilder($defaultData)
            ->add('contacts', EntityType::class, [
                'class' => Contacts::class,
                'choices' => $contacts,
                "multiple" => true,
                "expanded" => true,
            ])
            ->add("operation", HiddenType::class, [
                'data' => $operation->getCode()
            ])
            ->getForm();

        $formAddContacts->handleRequest($request);

        if ($formAddContacts->isSubmitted()) {
            //Operation envoyée
            $operation = $this->getDoctrine()
            ->getRepository(Operations::class)
            ->findOneBy(array("code" => $request->get("form")["operation"]));
            $author = $operation->getAuthor();
            $em = $this->getDoctrine()->getManager();
            dump($request->get("form")["contacts"]);
            //Récuperation des contacts ciblés
            $contactsCible = $this->getDoctrine()
            ->getRepository(Contacts::class)
            ->getContactsInArray($request->get("form")["contacts"]);
            dump($contactsCible);

            foreach($contactsCible as $contact){
                $operationSent = new OperationSent();
                $operationSent->setOperation($operation);
                $operationSent->setSalesperson($author);
                $operationSent->setContacts($contact);
                $operationSent->setUniqIdContact(\uniqid());
                $operationSent->setSentAt(new \DateTime());
                $em->persist($operationSent);
            }
            $em->flush();
            die();
            
        }
        $form = $this->createForm(OperationsType::class, $operation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
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
