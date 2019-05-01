<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Department;
use App\AdminBundle\Entity\AffectedArea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AffectedAreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add("id", HiddenType::class,[
            "required" => false
        ])
        ->add("libelle", TextType::class, [
            "label" => "Nom de la zone"
        ])
        ->add('departments', EntityType::class, [
            'class' => Department::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('department')
                    ->orderBy('department.libelle', 'ASC')
                    ->where('department.affectedArea is NULL');
            },
            "label" => "Départements",
            'required' => false,
            'multiple' => true
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AffectedArea::class,
        ]);
    }
}
