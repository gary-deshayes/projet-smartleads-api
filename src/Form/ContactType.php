<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code_customer')
            ->add('first_name')
            ->add('name')
            ->add('birth_date', DateType::class)
            ->add('mobile_phone')
            ->add('phone')
            ->add('email')
            ->add('company')
            ->add('gender')
            ->add('contactCompanyService')
            ->add('contactCompanyFunction')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
