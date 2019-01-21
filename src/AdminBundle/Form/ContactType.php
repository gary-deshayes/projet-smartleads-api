<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Gender;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contact;
use App\AdminBundle\Entity\ContactCompanyService;
use App\AdminBundle\Entity\ContactCompanyFunction;
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
            ->add('company', EntityType::class, array('class' => Company::class))
            ->add('gender', EntityType::class, array('class' => Gender::class))
            ->add('contactCompanyService',  EntityType::class, array('class' => ContactCompanyService::class))
            ->add('contactCompanyFunction', EntityType::class, array('class' => ContactCompanyFunction::class))
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