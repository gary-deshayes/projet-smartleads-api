<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contacts;
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

class ContactsType extends AbstractType
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
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Actif' => 1,
                    'Inactif' => 0
                ],
                'label' => "Statut :"
            ])
            ->add('profession', EntityType::class, [
                'label' => "Métier :",
                'class' => Profession::class
            ])
            ->add('Company', EntityType::class, [
                'class' => Company::class,
                'query_builder' => function (EntityRepository $er) {
                    //dump($er->createQueryBuilder('c')->getQuery()->getResult());
                    return $er->createQueryBuilder('c');
                        // ->orderBy('c.name', 'ASC');
                },
                "label" => "Entreprise : ",
                'required' => false
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
                "label" => "Téléphone mobile :",
                "required" => false
            ])
            ->add('phone',TelType::class, [
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
            ->add('comment', TextType::class, [
                "label" => "Commentaires",
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
