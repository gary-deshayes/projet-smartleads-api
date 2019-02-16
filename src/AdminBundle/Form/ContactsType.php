<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Contacts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ContactsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 0,
                    'Femme' => 1
                ],
                'label' => "Genre :"
            ])
            ->add('lastName', TextType::class, [
                "label" => "Nom de famille :"
            ])
            ->add('firstName', TextType::class, [
                "label" => "Prénom :"
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Actif' => 1,
                    'Inactif' => 0
                ],
                'label' => "Statut :"
            ])
            ->add('decisionLevel', ChoiceType::class, [
                'label' => "Niveau de décision :",
                'choices' => [
                    "1" => 1,
                    "2" => 2,
                    "3" => 3,
                    "4" => 4,
                    "5" => 5
                ]
            ])
            ->add('birthDate', DateType::class, [
                "label" => "Date de naissance :",
                'format' => 'dd-MM-yyyy',
                "years" => range(date('Y'), date('Y') - 70)
            ])
            ->add('mobilePhone', TelType::class, [
                "label" => "Téléphone mobile :"
            ])
            ->add('phone',TelType::class, [
                "label" => "Téléphone fixe :"
            ])
            ->add('email', EmailType::class, [
                "label" => "Email :"
            ])
            ->add('linkedin', UrlType::class, [
                "label" => "Lien LinkedIn :"
            ])
            ->add('picture', FileType::class, [
                "label" => "Image :"
            ])
            ->add('operationSource', ChoiceType::class, [
                'choices' => [
                    "Operation 1",
                    "Operation 2"
                ],
                "label" => "Opération qui a permis de créer le contact"
            ])
            ->add('comment', TextType::class, [
                "label" => "Commentaires"
            ])
            ->add('optInNewsletter', CheckboxType::class, [
                "label" => "Recevoir les newsletter"
            ])
            ->add('optInOffresCommercial', CheckboxType::class, [
                "label" => "Recevoir les offres commercial"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contacts::class,
        ]);
    }
}
