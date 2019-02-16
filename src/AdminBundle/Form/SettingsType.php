<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Settings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('applicationName')
            ->add('applicationLogo')
            ->add('address')
            ->add('additionalAddress')
            ->add('phone')
            ->add('fax')
            ->add('email')
            ->add('emailAdmin')
            ->add('emailContact')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Settings::class,
        ]);
    }
}
