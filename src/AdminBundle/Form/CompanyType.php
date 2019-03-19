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
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Piste' => 'Piste',
                    'Prospect' => 'Prospect',
                    'Client' => 'Client'
                ],
                'label' => "Statut"
            ])
            ->add('imageFile', FileType::class, [
                "required" => false,
                'data_class' => null
            ])
            ->add('comment', TextType::class, [
                "label" => "Remarques",
                "required" => false
            ])
            // ->add('country', TextType::class, [
            //     "label" => "Pays",
            //     "required" => false
            // ])
            ->add('address', TextType::class, [
                "label" => "Adresse",
                "required" => false
            ])
            ->add('additionalAddress', TextType::class, [
                "label" => "Complément ",
                "required" => false
            ])
            // ->add('decisionLevel', TextType::class, [
            //     "label" => "Potentiel",
            //     "required" => false
            // ])

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
            // ->add('createdAtCompany', DateType::class, [
            //     "label" => "Date de création",
            //     'format' => 'dd-MM-yyyy',
            //     "years" => range(date('Y'), date('Y') - 70)
            // ])
            ->add('siret', TextType::class, [
                "label" => "N°SIRET",
                "required" => false
            ])
            ->add('nafCode', TextType::class, [
                "label" => "Activité (NAF)",
                "required" => false
            ])
            // ->add('source', TextType::class, [
            //     "label" => "Source",
            //     "required" => false
            // ])
            // ->add('idActivityArea', EntityType::class, [
            //     'class' => ActivityArea::class,
            //     "label" => "Aire d'activité",
            //     'choice_label' => "libelle",
            //     'required' => false
            // ])
            // ->add('idCompanyCategory', EntityType::class, [
            //     'class' => CompanyCategory::class,
            //     "label" => "Catégorie de l'entreprise",
            //     'choice_label' => "libelle",
            //     'required' => false
            // ])
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
                    return $er->createQueryBuilder('n')
                        ->orderBy('n.libelle', 'ASC');
                },
                "label" => "Effectifs",
                'choice_label' => "libelle",
                'required' => false
            ])
            ->add('idTurnovers', EntityType::class, [
                'class' => Turnovers::class,
                "label" => "Chiffre d'affaires (M€)",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.libelle', 'ASC');
                },
                'choice_label' => "libelle",
                'required' => false,
                'multiple' => true
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
