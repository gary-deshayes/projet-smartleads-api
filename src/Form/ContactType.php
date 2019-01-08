<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code_customer', TextType::class)
            ->add('first_name', TextType::class)
            ->add('name', TextType::class)
            ->add('email', TextType::class)
            ->add('birth_date', DateType::class)    
            ->add('company', TextType::class)
            ->add('gender', TextType::class)
            ->add('contactCompanyService', TextType::class)
            ->add('contactCompanyFunction', TextType::class)
            ->add('mobile_phone', TextType::class)
            ->add('phone', TextType::class)
            ->add("save", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
