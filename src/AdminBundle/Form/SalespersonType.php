<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Salesperson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalespersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender')
            ->add('firstName')
            ->add('lastName')
            ->add('profile')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('status')
            ->add('birthDate')
            ->add('workName')
            ->add('mobilePhone')
            ->add('phone')
            ->add('email')
            ->add('linkedin')
            ->add('picture')
            ->add('idLeader')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salesperson::class,
        ]);
    }
}
