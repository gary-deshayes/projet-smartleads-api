<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\OperationSent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationSentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sentAt')
            ->add('idSalesperson')
            ->add('idOperation')
            ->add('idContacts')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OperationSent::class,
        ]);
    }
}
