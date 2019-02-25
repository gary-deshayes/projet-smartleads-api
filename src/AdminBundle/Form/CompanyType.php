<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('status')
            ->add('logo')
            ->add('comment')
            ->add('country')
            ->add('address')
            ->add('additionalAddress')
            ->add('postalCode')
            ->add('town')
            ->add('phone')
            ->add('fax')
            ->add('website')
            ->add('createdAtCompany')
            ->add('siret')
            ->add('nafCode')
            ->add('source')
            ->add('idActivityArea')
            ->add('idCompanyCategory')
            ->add('idSalesperson')
            ->add('idLegalStatus')
            ->add('idNumberEmployees')
            ->add('idTurnovers')
            ->add('idContact')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
