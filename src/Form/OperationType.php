<?php
namespace App\Form;

use App\Entity\Operation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OperationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("name", TextType::class)
                ->add("URL", UrlType::class)
                ->add("VisualHeader", TextType::class)
                ->add("VisualLateral", TextType::class)
                ->add("save", SubmitType::class, array("label" => "Créer l'opération"))
                ->getForm();

    }
}

?>