<?php

namespace App\AdminBundle\Controller;

use Faker;
use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Salesperson;
use App\AdminBundle\Form\SalespersonType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/salesperson")
 */
class SalespersonController extends AbstractController
{
    /**
     * @Route("/", name="salesperson_index", methods={"GET"})
     * @IsGranted("ROLE_DIRECTEUR", statusCode=403)
     */
    public function index(): Response
    {
        $salespeople = $this->getDoctrine()
            ->getRepository(Salesperson::class)
            ->findAll();

        return $this->render('salesperson/index.html.twig', [
            'salespeople' => $salespeople,
        ]);
    }

    /**
     * @Route("/new", name="salesperson_new", methods={"GET","POST"})
     * @IsGranted("ROLE_DIRECTEUR", statusCode=403)
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $repoSalesperson = $this->getDoctrine()->getRepository(Salesperson::class);
        $this->faker = Faker\Factory::create('fr_FR');
        $salesperson = new Salesperson();
        $form = $this->createForm(SalespersonType::class, $salesperson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->get("salesperson");
            do {
                $code = $this->faker->regexify("[A-Z]{10}");
            } while ($repoSalesperson->findOneBy(array("code" => $code)) != null);
            $roles = [];
            if ($data["profile"] == "Commercial") {
                $roles = ["ROLE_COMMERCIAL"];
            } else {
                $roles = ["ROLE_RESPONSABLE"];
            }
            $salesperson->setRoles($roles);
            $salesperson->setCode($code);
            $salesperson->setPassword($passwordEncoder->encodePassword($salesperson, $data["password"]));
            $salesperson->setCreatedAt(new \DateTime());
            $salesperson->setUpdatedAt(new \DateTime());
            $salesperson->setLeader($repoSalesperson->findOneBy(array("code" => $data["leader"])));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salesperson);
            $entityManager->flush();

            return $this->redirectToRoute('salesperson_index');
        }

        return $this->render('salesperson/new.html.twig', [
            'salesperson' => $salesperson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{code}", name="salesperson_show", methods={"GET"})
     * @IsGranted("ROLE_DIRECTEUR", statusCode=403)
     */
    public function show(Salesperson $salesperson): Response
    {
        return $this->render('salesperson/show.html.twig', [
            'salesperson' => $salesperson,
        ]);
    }

    /**
     * @Route("/{code}/edit", name="salesperson_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_DIRECTEUR", statusCode=403)
     */
    public function edit(Request $request, Salesperson $salesperson): Response
    {
        $form = $this->createForm(SalespersonType::class, $salesperson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salesperson_index', [
                'code' => $salesperson->getCode(),
            ]);
        }

        return $this->render('salesperson/edit.html.twig', [
            'salesperson' => $salesperson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{code}", name="salesperson_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Salesperson $salesperson): Response
    {
        if ($this->isCsrfTokenValid('delete' . $salesperson->getCode(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($salesperson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('salesperson_index');
    }

    /**
     * @Route("/responsable/team", name="salesperson_team")
     * @IsGranted("ROLE_RESPONSABLE", statusCode=403)
     */
    public function team()
    {
        if ($this->getUser()) {
            $repoSalesperson = $this->getDoctrine()->getRepository(Salesperson::class);
            $salespersons = $repoSalesperson->findBy(["idLeader" => $this->getUser()->getCode()]);
        }

        return $this->render('salesperson/team.html.twig', [
            "salespersons" => $salespersons
        ]);
    }

    /**
     * @Route("/responsable/team/ajout", name="salesperson_team_ajout_membre", methods={"GET","POST"})
     * @IsGranted("ROLE_RESPONSABLE", statusCode=403)
     */
    public function ajoutMembreTeam(Request $request)
    {
        $salesperson = new Salesperson();
        $repoSalesperson = $this->getDoctrine()->getRepository(Salesperson::class);
        $defaultData = ['message' => 'Type your message here'];

        $requeteCount = $repoSalesperson->createQueryBuilder('salesperson')
            ->select("count(salesperson)")
            ->where("salesperson.status = 1")
            ->andWhere('salesperson.roles like :roles')
            ->andWhere('salesperson.idLeader IS NULL')
            ->orderBy('salesperson.firstName', 'ASC')
            ->setParameter(":roles", '["ROLE_COMMERCIAL"]');

        $nb = $requeteCount->getQuery()->getSingleScalarResult();

        $form = $this->createFormBuilder($defaultData)
            ->add('salesperson', EntityType::class, [
                "label" => "Commercial :",
                'class' => Salesperson::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('salesperson')
                        ->where("salesperson.status = 1")
                        ->andWhere('salesperson.roles like :roles')
                        ->andWhere('salesperson.idLeader IS NULL')
                        ->orderBy('salesperson.firstName', 'ASC')
                        ->setParameter(":roles", '["ROLE_COMMERCIAL"]');
                },
                'required' => false
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $salesperson = $form["salesperson"]->getData();
            $salesperson->setLeader($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salesperson);
            $entityManager->flush();

            return $this->redirectToRoute('salesperson_team');
        }

        return $this->render('salesperson/ajout_membre.html.twig', [
            "formSalesperson" => $form->createView(),
            "nombreCommercial" => (int)$nb
        ]);
    }

    /**
     * @Route("/responsable/team/delete/{code}", name="salesperson_team_delete", methods={"GET"})
     * @IsGranted("ROLE_RESPONSABLE", statusCode=403)
     */
    public function team_delete(Request $request, Salesperson $salesperson): Response
    {
        $salesperson->setLeader(null);
        $entityManager = $this->getDoctrine()->getManager();
        $message;
        try {
            $entityManager->persist($salesperson);
            $entityManager->flush();
            $message = $salesperson->__toString() . " a été supprimé(e) de votre équipe";
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $this->addFlash(
            'message',
            $message
        );
        return $this->redirectToRoute('salesperson_team');
    }
    /**
     * @Route("/responsable/list", name="salesperson_list_responsable", methods={"GET"})
     * @IsGranted("ROLE_DIRECTEUR", statusCode=403)
     */
    public function list_responsable(): Response
    {
        $query = $this->getDoctrine()->getRepository(Salesperson::class)->createQueryBuilder('salesperson')
            ->andWhere('salesperson.roles like :roles')
            ->orderBy('salesperson.lastName', 'ASC')
            ->setParameter(":roles", '["ROLE_RESPONSABLE"]')->getQuery();
        $salespeople = $query->getResult();
        return $this->render('salesperson/list_responsable.html.twig', [
            'salespeople' => $salespeople,
        ]);
    }
}
