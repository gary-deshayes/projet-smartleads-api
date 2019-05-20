<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Country;
use App\AdminBundle\Entity\Turnovers;
use App\AdminBundle\Entity\Profession;
use App\AdminBundle\Entity\LegalStatus;
use App\AdminBundle\Entity\ActivityArea;
use Symfony\Component\Form\AbstractType;
use App\AdminBundle\Entity\CompanyStatus;
use App\AdminBundle\Entity\NumberEmployees;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\AdminBundle\Entity\ContactOperation;

class ContactsOperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //Partie contacts
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    "Non précisé" => "Non précisé",
                    'Homme' => "Homme",
                    'Femme' => "Femme"

                ],
                'label' => "Genre",
                "required" => false
            ])
            ->add('lastName', TextType::class, [
                "label" => "Nom",
                "required" => false
            ])
            ->add('firstName', TextType::class, [
                "label" => "Prénom",
                "required" => false
            ])

            ->add('birthDate', DateType::class, [
                "label" => "Date de naissance",
                'format' => 'dd-MM-yyyy',
                "years" => range(date('Y'), date('Y') - 70),
                'widget' => 'single_text',
                'html5' => false,
                "required" => false
            ])
            ->add('email_contact', EmailType::class, [
                "label" => "Email",
                "required" => false
            ])

            ->add('mobilePhone', TelType::class, [
                "label" => "Tél. mobile",
                "required" => false
            ])
            ->add('phone', TelType::class, [
                "label" => "Tél. Fixe",
                "required" => false
            ])
            ->add('linkedin', UrlType::class, [
                "label" => "Profil Linkedin",
                "required" => false
            ])
            ->add('facebook', UrlType::class, [
                "label" => "Profil Facebook",
                "required" => false
            ])
            ->add('twitter', UrlType::class, [
                "label" => "Profil Twitter",
                "required" => false
            ])
            ->add('profession', EntityType::class, [
                'label' => "Métier",
                'class' => Profession::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.libelle', 'ASC');
                },
                "required" => false
            ])
            ->add('workname', TextType::class, [
                "label" => "Nom du poste",
                "required" => false
            ])
            //Partie entreprise

            ->add('name_company', TextType::class, [
                "label" => "Nom",
                "required" => false
            ])
            ->add('activityArea', EntityType::class, [
                "label" => "Activité (NAF)",
                'class' => ActivityArea::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('activity')
                        ->orderBy('activity.libelle', 'ASC');
                },
                "required" => false
            ])
            ->add('legalStatus', EntityType::class, [
                'class' => LegalStatus::class,
                "label" => "Statut juridique",
                'choice_label' => "libelle",
                "required" => false
            ])
            ->add('siret', TextType::class, [
                "label" => "N°SIRET",
                "required" => false
            ])
            ->add('numberEmployees', EntityType::class, [
                'class' => NumberEmployees::class,

                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('numberEmployees')
                        ->orderBy('numberEmployees.libelle', 'ASC');
                },
                "label" => "Effectifs",
                'choice_label' => "libelle",
                "required" => false
            ])
            ->add('turnovers', EntityType::class, [
                'class' => Turnovers::class,
                "label" => "Chiffre d'affaires (M€)",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('turnovers')
                        ->orderBy('turnovers.libelle', 'ASC');
                },
                'choice_label' => "libelle",
                "required" => false
            ])
            ->add('address', TextType::class, [
                "label" => "Adresse",
                "required" => false
            ])
            ->add('postalCode', TextType::class, [
                "label" => "Code postal",
                "required" => false
            ])
            ->add('country', EntityType::class, [
                "label" => "Pays",
                'class' => Country::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('country')
                        ->orderBy('country.libelle', 'ASC');
                }
            ])
            ->add('email_company', EmailType::class, [
                "label" => "Email",
                "required" => false
            ])
            ->add('phone_company', TelType::class, [
                "label" => "Téléphone",
                "required" => false,
                "help" => "Format 0612345678"
            ])
            ->add('fax', TelType::class, [
                "label" => "Fax",
                "required" => false,
                "help" => "Format 0612345678"
            ])
            ->add('website', UrlType::class, [
                "label" => "Site web",
                "required" => false
            ]);
    }
}
