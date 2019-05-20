<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use App\AdminBundle\Entity\TargetOperation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;

class TargetOperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('entity', ChoiceType::class, [
            'choices'  => [
                'Entreprises' => "Company",
                'Contacts' => "Contacts",
                'Commerciaux' => "Salesperson",
            ],
        ])
        ->add('parameter', ChoiceType::class, [
            "allow_extra_fields" => true,
            'choice_loader' => null
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TargetOperation::class,
            "allow_extra_fields" => true
        ]);
    }
}
