<?php

namespace App\Form;

use App\Entity\Parameter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParameterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_application')
            ->add('logo_client')
            ->add('address')
            ->add('address_complement')
            ->add('mobile')
            ->add('fax')
            ->add('email_contact')
            ->add('email_admin')
            ->add('email_receipt_requests')
            ->add('user')
            ->add('operation')
            ->add('contactjobs')
            ->add('companyActivityArea')
            ->add('companyCategory')
            ->add('companyNbEmployees')
            ->add('companyTurnover')
            ->add('companyLastTurnover')
            ->add('parameterComportment')
            ->add('parameterObject')
            ->add('parameterTarget')
            ->add('parameterTypeSite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parameter::class,
        ]);
    }
}
