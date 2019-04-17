<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use App\AdminBundle\Entity\FormulaireOperation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FormulaireOperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        

        $builder->add('contacts_gender', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true,
            'attr' => ['class' => 'custom-control custom-checkbox']
        ])->add('contacts_firstname', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true,
            'attr' => ['class' => 'custom-control custom-checkbox']
        ])->add('contacts_lastname', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true,
            'attr' => ['class' => 'custom-control custom-checkbox']
        ])->add('contacts_birthdate', ChoiceType::class, [
            'choices' => [
                "Affiché" => 1,
                "Editable" => 2,
                "Requis" => 3
            ],
            'expanded' => true,
            'multiple' => true,
            'attr' => ['class' => 'custom-control custom-checkbox']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormulaireOperation::class,
        ]);
    }
}
