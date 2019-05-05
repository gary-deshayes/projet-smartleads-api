<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Turnovers;
use App\AdminBundle\Entity\ActivityArea;
use Symfony\Component\Form\AbstractType;
use App\AdminBundle\Entity\CompanyCategory;
use App\AdminBundle\Entity\NumberEmployees;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Proxies\__CG__\App\AdminBundle\Entity\LegalStatus;
use Proxies\__CG__\App\AdminBundle\Entity\Salesperson;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use App\AdminBundle\Entity\CompanyStatus;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, [
                "label" => "Code entreprise",
                "required" => false
            ])
            ->add('name', TextType::class, [
                "label" => "Nom"
            ])
            ->add('companyStatus', EntityType::class, [
                "label" => "Statut",
                'class' => CompanyStatus::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('companyStatus')
                        ->orderBy('companyStatus.libelle', 'ASC');
                },
                'required' => false
            ])
            ->add('imageFile', FileType::class, [
                "required" => false,
                'data_class' => null
            ])
            ->add('comment', TextType::class, [
                "label" => "Remarques",
                "required" => false
            ])
            ->add('address', TextType::class, [
                "label" => "Adresse",
                "required" => false
            ])
            ->add('additionalAddress', TextType::class, [
                "label" => "Complément ",
                "required" => false
            ])
            ->add('email', EmailType::class, [
                "label" => "Email",
                "required" => false
            ])
            ->add('postalCode', TextType::class, [
                "label" => "Code postal",
                "required" => false
            ])
            ->add('town', TextType::class, [
                "label" => "Ville",
                "required" => false
            ])
            ->add('phone', TelType::class, [
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
            ])
            ->add('siret', TextType::class, [
                "label" => "N°SIRET",
                "required" => false
            ])
            ->add('activityArea', EntityType::class, [
                "label" => "Activité (NAF)",
                'class' => ActivityArea::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('activity')
                        ->orderBy('activity.libelle', 'ASC');
                },
                'required' => false
            ])
            ->add('idSalesperson', EntityType::class, [
                'class' => Salesperson::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.lastName', 'ASC');
                },
                "label" => "Compte suivi par",
                'required' => false
            ])
            ->add('idLegalStatus', EntityType::class, [
                'class' => LegalStatus::class,
                "label" => "Statut juridique",
                'choice_label' => "libelle",
                'required' => false
            ])
            ->add('idNumberEmployees', EntityType::class, [
                'class' => NumberEmployees::class,
                
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('numberEmployees')
                        ->orderBy('numberEmployees.libelle', 'ASC');
                },
                "label" => "Effectifs",
                'choice_label' => "libelle",
                'required' => false
            ])
            ->add('turnovers', EntityType::class, [
                'class' => Turnovers::class,
                "label" => "Chiffre d'affaires (M€)",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('turnovers')
                        ->orderBy('turnovers.libelle', 'ASC');
                },
                'choice_label' => "libelle",
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
