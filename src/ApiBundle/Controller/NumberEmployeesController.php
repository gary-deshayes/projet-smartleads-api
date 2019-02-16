<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\NumberEmployees;
use App\AdminBundle\Form\NumberEmployeesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/number/employees")
 */
class NumberEmployeesController extends AbstractController
{
    /**
     * @Route("/", name="number_employees_index", methods={"GET"})
     */
    public function index(): Response
    {
        $numberEmployees = $this->getDoctrine()
            ->getRepository(NumberEmployees::class)
            ->findAll();

        return $this->render('number_employees/index.html.twig', [
            'number_employees' => $numberEmployees,
        ]);
    }

    /**
     * @Route("/new", name="number_employees_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $numberEmployee = new NumberEmployees();
        $form = $this->createForm(NumberEmployeesType::class, $numberEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($numberEmployee);
            $entityManager->flush();

            return $this->redirectToRoute('number_employees_index');
        }

        return $this->render('number_employees/new.html.twig', [
            'number_employee' => $numberEmployee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="number_employees_show", methods={"GET"})
     */
    public function show(NumberEmployees $numberEmployee): Response
    {
        return $this->render('number_employees/show.html.twig', [
            'number_employee' => $numberEmployee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="number_employees_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NumberEmployees $numberEmployee): Response
    {
        $form = $this->createForm(NumberEmployeesType::class, $numberEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('number_employees_index', [
                'id' => $numberEmployee->getId(),
            ]);
        }

        return $this->render('number_employees/edit.html.twig', [
            'number_employee' => $numberEmployee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="number_employees_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NumberEmployees $numberEmployee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$numberEmployee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($numberEmployee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('number_employees_index');
    }
}
