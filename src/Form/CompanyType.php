<?php

namespace App\AdminBundle\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company_code')
            ->add('name')
            // ->add('created_at_plug')
            // ->add('update_at_plug')
            ->add('leader_code')
            ->add('status')
            ->add('logo')
            ->add('commentary')
            ->add('coutry')
            ->add('adress')
            ->add('adress_complement')
            ->add('postal_code')
            ->add('city')
            ->add('phone')
            ->add('fax')
            ->add('website')
            ->add('adress_commentary')
            ->add('created_at')
            ->add('siret_number')
            ->add('naf_code')
            ->add('source')
            // ->add('idCountry')
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
