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
                "label" => "Nom de l'application",
                "required" => true
            ])
            ->add('address', TextType::class, [
                "label" => "Adresse",
                "required" => false
            ])
            ->add('additionalAddress', TextType::class, [
                "label" => "Complétement",
                "required" => false
            ])
            ->add('phone', TextType::class, [
                "label" => "Téléphone",
                "required" => false
            ])
            ->add('fax', TextType::class, [
                "label" => "Fax",
                "required" => false
            ])
            ->add('email', TextType::class, [
                "label" => "Email",
                "required" => false
            ])
            ->add('emailAdmin', TextType::class, [
                "label" => "Email de l'admin",
                "required" => false
            ])
            ->add('emailContact', TextType::class, [
                "label" => "Email contact",
                "required" => false
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
