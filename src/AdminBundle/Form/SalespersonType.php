<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Salesperson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SalespersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, [
                "label" => "Code collaborateur",
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
            ->add('profile', ChoiceType::class, [
                'choices'  => [
                    "Responsable commercial" => "Responsable commercial",
                    'Commercial' => "Commercial"

                ],
                'label' => "Profil/droits"
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Actif' => 1,
                    'Inactif' => 0
                ],
                'label' => "Statut"
            ])
            ->add('birthDate', DateType::class, [
                "label" => "Date de naissance",
                'format' => 'dd-MM-yyyy',
                "years" => range(date('Y'), date('Y') - 70)
            ])
            ->add('arrivalDate', DateType::class, [
                "label" => "Date de naissance",
                'format' => 'dd-MM-yyyy',
                "years" => range(date('Y'), date('Y') - 70)
            ])
            ->add('departureDate', DateType::class, [
                "label" => "Date de naissance",
                'format' => 'dd-MM-yyyy',
                "years" => range(date('Y'), date('Y') - 70)
            ])
            ->add('workname', TextType::class, [
                "label" => "Fonction/poste"
            ])
            ->add('mobilePhone', TelType::class, [
                "label" => "Téléphone mobile",
                "required" => false
            ])
            ->add('phone', TelType::class, [
                "label" => "Tel. fixe direct",
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
            ->add('comment', TextareaType::class, [
                "label" => "Remarques",
                "required" => false
            ])
            ->add('password', PasswordType::class, [
                "label" => "Mot de passe",
                "required" => true,
                'data_class' => null
            ])
            ->add('leader', EntityType::class, [
                'class' => Salesperson::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('salesperson')
                        ->where("salesperson.status = 1")
                        ->andWhere('salesperson.roles like :roles')
                        ->orderBy('salesperson.firstName', 'ASC')
                        ->setParameter(":roles", '["ROLE_RESPONSABLE"]');
                },
                'required' => false,
                "label" => "Responsable N+1"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salesperson::class,
        ]);
    }
}
