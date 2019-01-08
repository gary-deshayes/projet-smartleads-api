<?php

namespace App\Form;

use App\Entity\Gender;
use App\Entity\Contact;
use App\Entity\ContactCompanyService;
use App\Entity\ContactCompanyFunction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('gender', EntityType::class, array('class' => Gender::class,'choice_label' => 'Genre :'))
            ->add('contactCompanyService',  EntityType::class, array('class' => ContactCompanyService::class,'choice_label' => 'Service dans l\'entreprise'))
            ->add('contactCompanyFunction', EntityType::class, array('class' => ContactCompanyFunction::class,'choice_label' => 'Fonction dans l\'entreprise'))
            ->add('mobile_phone', TextType::class)
            ->add('phone', TextType::class)
            ->add("save", SubmitType::class)
            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
