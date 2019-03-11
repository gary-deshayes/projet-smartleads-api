<?php

namespace App\AdminBundle\Controller;

use Faker;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Settings;
use App\AdminBundle\Entity\Profession;
use App\AdminBundle\Form\ContactsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/contacts")
 */
class ContactsController extends AbstractController
{
    /** @var Faker */
    protected $faker;

    /**
     * @Route("/", name="contacts_index", methods={"GET"})
     */
    public function index(): Response
    {   
        $repositoryCompany = $this->getDoctrine()->getRepository(Company::class);
        $repositoryContacts = $this->getDoctrine()->getRepository(Contacts::class);
        //Affichage des contacts du commercial
        if($this->isGranted("ROLE_COMMERCIAL") || $this->isGranted("ROLE_RESPONSABLE")){
            $companies = $repositoryCompany->findBy(array("idSalesperson"=> $this->getUser()->getCode()));
            $contacts = $repositoryContacts->findBy(
                array("company" => $companies),
                array("lastName" => "ASC")
            );
        } else {
            $contacts = $this->getDoctrine()
            ->getRepository(Contacts::class)
            ->findBy(array(), array('lastName' => 'ASC'));
        }
        dump($contacts);


        


        $settings = $this->getDoctrine()
            ->getRepository(Settings::class)
            ->findAll();

        return $this->render('contacts/index.html.twig', [
            'contacts' => $contacts,
            'settings' => $settings
        ]);
    }

    /**
     * @Route("/new", name="contacts_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $repoContact = $this->getDoctrine()->getRepository(Contacts::class);
        $this->faker = Faker\Factory::create('fr_FR');
        $contact = new Contacts();
        $form = $this->createForm(ContactsType::class, $contact);
        $form->handleRequest($request);
        $data = $request->request->get("contacts");
        if ($form->isSubmitted() && $form->isValid()) {
            do{
                $code = $this->faker->regexify("[A-Z]{10}");
                
            }while($repoContact->findOneBy(array("code" => $code)) != null);
            // 23 caractere unique
            // $nomImage = uniqid('', true) . ".jpg";

            // $file = $form['picture']->getData();
            // $file->move("img/", $nomImage);
            // $contact->setPicture($nomImage);
            $contact->setCode($code);
            $contact->setCreatedAt(new \DateTime());
            $contact->setUpdatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contacts_index');
        }
        return $this->render('contacts/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{code}", name="contacts_show", methods={"GET"})
     */
    public function show(Contacts $contact): Response
    {
        return $this->render('contacts/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{code}/edit", name="contacts_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contacts $contact): Response
    {
        $form = $this->createForm(ContactsType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contacts_index', [
                'code' => $contact->getCode(),
            ]);
        }

        return $this->render('contacts/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{code}", name="contacts_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contacts $contact): Response
    {
        if ($this->isCsrfTokenValid('delete' . $contact->getCode(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contacts_index');
    }
}
