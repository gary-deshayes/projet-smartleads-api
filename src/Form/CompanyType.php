<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company_code', TextType::class)
            ->add('name', TextType::class)
            ->add('leader_code', TextType::class)
            ->add('status', TextType::class)
            ->add('logo', UrlType::class)
            ->add('commentary', TextType::class)
            ->add('adress')
            ->add('adress_complement', TextType::class)
            ->add('postal_code', TextType::class)
            ->add('city', TextType::class)
            ->add('phone', TextType::class)
            ->add('fax', TextType::class)
            ->add('website', TextType::class)
            ->add('adress_commentary', TextType::class)
            ->add('created_at', TextType::class)
            ->add('siret_number', TextType::class)
            ->add('naf_code', TextType::class)
            ->add('source', TextType::class)
            // ->add('idCountry', EntityType::class, array('class' => OperationTypeOperation::class,'choice_label' => 'Type de l\'opération')))
            // ->add('idActivityArea')
            // ->add('idLegalStatus')
            // ->add('idTurnover')
            // ->add('idLastTurnover')
            // ->add('user')
            // ->add('country')
            // ->add('companyCategory')
            // ->add('companyNbEmployees')
            // ->add('parameterComportment')
            // ->add('parameterObject')
            // ->add('parameterTarget')
            // ->add('parameterTypeSite')
            ->add("save", SubmitType::class, array("label" => "Créer l'entreprise"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
