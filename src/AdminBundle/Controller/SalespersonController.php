<?php

namespace App\AdminBundle\Controller;

use Faker;
use App\AdminBundle\Entity\Salesperson;
use App\AdminBundle\Form\SalespersonType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/salesperson")
 * @IsGranted("ROLE_DIRECTEUR", statusCode=403)
 */
class SalespersonController extends AbstractController
{
    /**
     * @Route("/", name="salesperson_index", methods={"GET"})
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
            do{
                $code = $this->faker->regexify("[A-Z]{10}");
                
            }while($repoSalesperson->findOneBy(array("code" => $code)) != null);
            $roles = [];
            if($data["profile"] == "Commercial"){
                $roles = ["ROLE_COMMERCIAL"];
            } else {
                $roles = ["ROLE_RESPONSABLE"];
            }
            $salesperson->setRoles($roles);
            $salesperson->setCode($code);
            $salesperson->setPassword($passwordEncoder->encodePassword($salesperson, "azerty"));
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
     */
    public function show(Salesperson $salesperson): Response
    {
        dump($salesperson);
        return $this->render('salesperson/show.html.twig', [
            'salesperson' => $salesperson,
        ]);
    }

    /**
     * @Route("/{code}/edit", name="salesperson_edit", methods={"GET","POST"})
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
        if ($this->isCsrfTokenValid('delete'.$salesperson->getCode(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($salesperson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('salesperson_index');
    }
}
