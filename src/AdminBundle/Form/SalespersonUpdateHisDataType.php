<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Salesperson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SalespersonUpdateHisDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mobilePhone', TelType::class, [
                "label" => "Tél. mobile",
                "required" => false
            ])
            ->add('email', EmailType::class, [
                "label" => "E-mail",
                "required" => false
            ])
            ->add('linkedin', UrlType::class, [
                "label" => "Profil LinkedIn",
                "required" => false
            ])
            ->add('twitter', UrlType::class, [
                "label" => "Profil Twitter",
                "required" => false
            ])
            ->add('facebook', UrlType::class, [
                "label" => "Profil Facebook",
                "required" => false
            ])
            ->add('imageFile', FileType::class, [
                "label" => "Photo",
                "required" => false,
                'data_class' => null
            ])
            ->add('password', PasswordType::class, [
                "label" => "Mot de passe",
                "required" => false,
                'data_class' => null,
                'empty_data' => ''
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salesperson::class,
        ]);
    }
}
