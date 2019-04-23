<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Settings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('applicationName', TextType::class, [
                "label" => "Nom de l'application"
            ])
            ->add('address', TextType::class, [
                "label" => "Adresse"
            ])
            ->add('additionalAddress', TextType::class, [
                "label" => "Complétement"
            ])
            ->add('phone', TextType::class, [
                "label" => "Téléphone"
            ])
            ->add('fax', TextType::class, [
                "label" => "Fax"
            ])
            ->add('email', TextType::class, [
                "label" => "Email"
            ])
            ->add('emailAdmin', TextType::class, [
                "label" => "Email de l'admin"
            ])
            ->add('emailContact', TextType::class, [
                "label" => "Email contact"
            ])
            ->add('imageFile', FileType::class, [
                "required" => false,
                'data_class' => null
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Settings::class,
        ]);
    }
}
