<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Region;
use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Department;
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
use App\AdminBundle\Entity\AffectedArea;

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
            ->add('birthDate', DateType::class, [
                "label" => "Date de naissance",
                'format' => 'dd/MM/yyyy',
                "years" => range(date('Y'), date('Y') - 70),
                'widget' => 'single_text',
                'html5' => false,
                "required" => false
            ])
            ->add('arrivalDate', DateType::class, [
                
                "label" => "Date d'arrivée/départ",
                'format' => 'dd/MM/yyyy',
                "years" => range(date('Y'), date('Y') - 70),
                'widget' => 'single_text',
                'html5' => false,
                'required' => false
            ])
            ->add('departureDate', DateType::class, [
                
                'format' => 'dd/MM/yyyy',
                "years" => range(date('Y'), date('Y') - 70),
                'widget' => 'single_text',
                'html5' => false,
                'required' => false
            ])
            ->add('workname', TextType::class, [
                "label" => "Fonction/poste",
                "required" => false
            ])
            ->add('mobilePhone', TelType::class, [
                "label" => "Tél. mobile",
                "required" => false
            ])
            ->add('phone', TelType::class, [
                "label" => "Tél. fixe direct",
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
                "required" => false,
                'data_class' => null,
                'empty_data' => ''
            ])
            ->add('leader', EntityType::class, [
                'class' => Salesperson::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('salesperson')
                        ->where("salesperson.status = 1")
                        ->andWhere('salesperson.roles like :roles')
                        ->orderBy('salesperson.lastName', 'ASC')
                        ->setParameter(":roles", '["ROLE_RESPONSABLE"]');
                },
                'required' => false,
                "label" => "Responsable N+1"
            ])
            ->add('affectedArea', EntityType::class, [
                'class' => AffectedArea::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('affectedArea')
                        ->orderBy('affectedArea.libelle', 'ASC');
                },
                'required' => false,
                "label" => "Zone affectée"
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
