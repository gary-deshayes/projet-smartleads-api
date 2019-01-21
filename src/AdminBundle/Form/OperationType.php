<?php
namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\User;
use App\AdminBundle\Entity\Operation;
use App\AdminBundle\Entity\Parameter;
use App\AdminBundle\Entity\OperationTypeOperation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OperationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("name", TextType::class)
                ->add("URL", UrlType::class)
                ->add("VisualHeader", TextType::class)
                ->add("VisualLateral", TextType::class)
                ->add('type', EntityType::class, array('class' => OperationTypeOperation::class,'choice_label' => 'Type de l\'opération'))
                ->add('user', EntityType::class, array('class' => User::class,'choice_label' => 'Utilisateur'))
                ->add('parametre', EntityType::class, array('class' => Parameter::class,'choice_label' => 'Paramètre'))
                ->add("save", SubmitType::class, array("label" => "Créer l'opération"))
                ->getForm();

    }
}

?>