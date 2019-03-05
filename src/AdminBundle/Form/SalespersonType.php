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

class SalespersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    "Non précisé" => "Non précisé",
                    'Homme' => "Homme",
                    'Femme' => "Femme"

                ],
                'label' => "Genre :"
            ])
            ->add('lastName', TextType::class, [
                "label" => "Nom de famille :"
            ])
            ->add('firstName', TextType::class, [
                "label" => "Prénom :"
            ])
            ->add('profile', ChoiceType::class, [
                'choices'  => [
                    "Responsable commercial" => "Responsable commercial",
                    'Commercial' => "Commercial"

                ],
                'label' => "Profil :"
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Actif' => 1,
                    'Inactif' => 0
                ],
                'label' => "Statut :"
            ])
            ->add('birthDate', DateType::class, [
                "label" => "Date de naissance :",
                'format' => 'dd-MM-yyyy',
                "years" => range(date('Y'), date('Y') - 70)
            ])
            ->add('workname', TextType::class, [
                "label" => "Poste :"
            ])
            ->add('mobilePhone', TelType::class, [
                "label" => "Téléphone mobile :",
                "required" => false
            ])
            ->add('phone', TelType::class, [
                "label" => "Téléphone fixe :",
                "required" => false
            ])
            ->add('email', EmailType::class, [
                "label" => "Email :",
                "required" => false
            ])
            ->add('linkedin', UrlType::class, [
                "label" => "Lien LinkedIn :",
                "required" => false
            ])
            ->add('picture', FileType::class, [
                "label" => "Image :",
                "required" => false,
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
                'required' => false
            ])
            // ->add('idLeader')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salesperson::class,
        ]);
    }
}
