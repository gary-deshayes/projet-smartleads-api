<?php
namespace App\ApiBundle\Controller;

use App\ApiBundle\Entity\Operation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * @Route("/operation")
 */
class OperationController extends AbstractController
{
    /**
     * @Route("/new")
     */
    public function new(Request $request)
    {
        $operation = new Operation();
        
        $form = $this->createFormBuilder($operation)
                     ->add("name", TextType::class)
                     ->add("URL", UrlType::class)
                     ->add("VisualHeader", TextType::class)
                     ->add("VisualLateral", TextType::class)
                     ->add("save", SubmitType::class, array("label" => "Créer l'opération"))
                     ->getForm();
        return $this->render("operation/new.html.twig", array(
            'form' => $form->createView(),
        ));

        $form->handleRequest($request);


        //Validation
        if($form->isSubmitted() && $form->isValid()){
            $operation = $form->getData();

            return $this->redirectToRoute("operation_success");

        }

        
    }

    /**
     * @Route("/edit/{id}")
     */
    public function edit(Request $request)
    {
    }

    /**
     * @Route("/delete/{id}")
     */
    public function delete(Request $request)
    {
    }

    /**
     * @Route("/list")
     */
    public function list(Request $request)
    {
    }
}

?>