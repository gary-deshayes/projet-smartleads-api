<?php

namespace App\Controller;

use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\OperationSent;
use App\AdminBundle\Form\OperationSentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\AdminBundle\Form\ContactsOperationType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $operation = $this->getDoctrine()
            ->getRepository(Operations::class)
            ->findOneBy(array("name" => $request->get("name")));

        $idContact = $this->getDoctrine()
            ->getRepository(OperationSent::class)
            ->getContactOperationSent($request->get("uniqid"));
        $contact = $this->getDoctrine()
            ->getRepository(Contacts::class)->findOneBy(array("code" => $idContact[0]["operationSent_id_contacts"]));
        if ($contact != null) {

            $form = $this->createForm(ContactsOperationType::class, $contact);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $contact->setUpdatedAt(new \DateTime());
                $this->getDoctrine()->getManager()->flush();

                die("Merci de la mise à jour");
            }
            return $this->render("template_operations/operation_commerciale.html.twig", [
                "contact" => $contact,
                "operation" => $operation,
                "formContact" => $form->createView()
            ]

            );
        }
        die("toto");
    }
}
