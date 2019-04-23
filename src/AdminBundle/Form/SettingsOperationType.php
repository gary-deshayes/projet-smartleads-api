<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use App\AdminBundle\Entity\SettingsOperation;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SettingsOperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mail_object', TextType::class, [
                "label" => "Objet du mail",
                "required" => false
            ])
            ->add('text_mail', TextAreaType::class, [
                "label" => "Texte du email",
                "required" => true
            ])
            ->add('libelle_button_mail', TextType::class, [
                "label" => "Libellé du bouton"
            ])
            ->add('title_page', TextType::class, [
                "label" => "Titre de la page"
            ])
            ->add('introduction_title', TextType::class, [
                "label" => "Titre d'introduction",
                "required" => true
            ])
            ->add('introduction_text', TextAreaType::class, [
                "label" => "Texte d'introduction",
                "required" => true
            ])
            ->add('libelle_button_page', TextType::class, [
                "label" => "Libellé du bouton"
            ])
            ->add('button_reject', CheckboxType::class, [
                "label" => "Bouton de refus"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SettingsOperation::class
        ]);
    }
}
