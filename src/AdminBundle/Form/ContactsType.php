<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Salesperson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Proxies\__CG__\App\AdminBundle\Entity\Profession;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, [
                "label" => "Code client",
                "required" => false
            ])
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    "Non précisé" => "Non précisé",
                    'Homme' => "Homme",
                    'Femme' => "Femme"
                    
                ],
                'label' => "Genre"
            ])
            ->add('lastName', TextType::class, [
                "label" => "Nom"
            ])
            ->add('firstName', TextType::class, [
                "label" => "Prénom"
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Actif' => 1,
                    'Inactif' => 0
                ],
                'label' => "Statut"
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
            ->add('Company', EntityType::class, [
                'class' => Company::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                "label" => "Entreprise",
                'required' => false
            ])
            ->add('workName', TextType::class, [
                "label" => "Nom du poste"
            ])
            ->add('salesperson', EntityType::class, [
                'class' => Salesperson::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.lastName', 'ASC');
                },
                "label" => "Responsable",
                'required' => false
            ])
            ->add('decisionMaking', ChoiceType::class, [
                'label' => "Niveau de décision",
                'choices' => [
                    "Responsable technique" => "Responsable technique",
                    "Cadre" => "Cadre",
                    "Cadre supérieur" => "Cadre supérieur"
                ]
            ])
            ->add('birthDate', DateType::class, [
                "label" => "Date de naissance",
                'format' => 'dd-MM-yyyy',
                "years" => range(date('Y'), date('Y') - 70)
            ])
            ->add('mobilePhone', TelType::class, [
                "label" => "Tél. mobile",
                "required" => false
            ])
            ->add('phone',TelType::class, [
                "label" => "Tél. Fixe",
                "required" => false
            ])
            ->add('email', EmailType::class, [
                "label" => "Email",
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
            ->add('imageFile', FileType::class, [
                "label" => "Photo",
                "required" => false,
                'data_class' => null
            ])
            ->add('comment', TextareaType::class, [
                "label" => "Remarques",
                "required" => false
            ])
            ->add('optInNewsletter', CheckboxType::class, [
                "label" => "Recevoir les newsletter",
                "required" => false
            ])
            ->add('optInOffresCommercial', CheckboxType::class, [
                "label" => "Recevoir les offres commercial",
                "required" => false
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
