<?php

namespace App\Controller;

use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\OperationSent;
use App\AdminBundle\Form\ContactsOperationType;
use App\AdminBundle\Form\OperationSentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\AdminBundle\Entity\FormulaireOperation;

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

                    $contact = $operationSent->getContacts();
                    if ($contact != null) {
                        //On mets à vu le concours
                        $operationSent->setState(2);
                        $this->getDoctrine()->getManager()->persist($operationSent);
                        $this->getDoctrine()->getManager()->flush();

                        $form = $this->createForm(ContactsOperationType::class);
                        $form->handleRequest($request);
                        if ($form->isSubmitted() && $form->isValid()) {
                            $contact->setUpdatedAt(new \DateTime());
                            //On mets à mis à jour le concours
                            $operationSent->setState(3);
                            $this->getDoctrine()->getManager()->persist($operationSent);
                            $this->getDoctrine()->getManager()->flush();
                            return $this->render("template_operations/thanks.html.twig", ["operation" => $operation]);
                        }
                        //Récupération des options du formulaire
                        $formulaire_options = $this->getDoctrine()->getRepository(FormulaireOperation::class)->findOneBy(array("operation" => $operation->getCode()));
                        dump($formulaire_options);
                        return $this->render(
                            "template_operations/operation_commerciale.html.twig",
                            [
                                "contact" => $contact,
                                "operation" => $operation,
                                "formContact" => $form->createView(),
                                "formulaire_options" => $formulaire_options
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
}
