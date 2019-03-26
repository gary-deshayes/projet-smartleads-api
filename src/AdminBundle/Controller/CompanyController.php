<?php

namespace App\AdminBundle\Controller;

use Faker;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Form\CompanyType;
use App\AdminBundle\Entity\Salesperson;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\AdminBundle\Form\SearchType;
use App\AdminBundle\EntitySearch\Search;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/", name="company_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new Search();

        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        $queryCompanies = $this->getDoctrine()
                ->getRepository(Company::class)
                ->getCompanies($search);
        
        $pageCompanies = $paginator->paginate(
            $queryCompanies,
            $request->query->getInt('page', 1,10)
        );

        $nbCompanies = $this->getDoctrine()
        ->getRepository(Company::class)
        ->getCountAllCompanies();

        return $this->render('company/index.html.twig', [
            'companies' => $pageCompanies,
            'nbCompanies' => $nbCompanies,
            'formsearch' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="company_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $repoCompany = $this->getDoctrine()->getRepository(Company::class);
        $this->faker = Faker\Factory::create('fr_FR');
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            do{
                $code = $this->faker->regexify("[A-Z]{10}");
                
            }while($repoCompany->findOneBy(array("code" => $code)) != null);
            //dump($request);
            $company->setCode($code);
            $company->setCreatedAt(new \DateTime());
            $company->setUpdatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('company_index');
        }

        return $this->render('company/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{code}", name="company_show", methods={"GET"})
     */
    public function show(Company $company): Response
    {
        return $this->render('company/show.html.twig', [
            'company' => $company,
        ]);
    }

    /**
     * @Route("/{code}/edit", name="company_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Company $company): Response
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('company_index', [
                'code' => $company->getCode(),
            ]);
        }

        return $this->render('company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{code}", name="company_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Company $company): Response
    {
        if ($this->isCsrfTokenValid('delete'.$company->getCode(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($company);
            $entityManager->flush();
        }

        return $this->redirectToRoute('company_index');
    }
}
