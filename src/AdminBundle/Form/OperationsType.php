<?php

namespace App\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\Salesperson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OperationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, [
                "label" => "Code opération",
                "required" => false
            ])
            ->add('name', TextType::class, [
                "label" => "Nom de l'opération",
                "required" => false
            ])
            ->add('template', TextType::class, [
                "label" => "Template",
                "required" => false
            ])
            ->add('mail_object', TextType::class, [
                "label" => "Objet du mail",
                "required" => false
            ])
            ->add('revival', ChoiceType::class, [
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                "label" => "Nb de relances auto",
                "required" => false
            ])
            ->add('sending_date', DateType::class, [
                "label" => "Date d'envoi",
                'format' => 'dd-MM-yyyy',
                "years" => range(date('Y'), date('Y') - 70),
                'widget' => 'single_text',
                'html5' => false,
                "required" => false
            ])
            ->add('closing_date', DateType::class, [
                "label" => "Date de clôture",
                'format' => 'dd-MM-yyyy',
                "years" => range(date('Y'), date('Y') - 70),
                'widget' => 'single_text',
                'html5' => false,
                "required" => false
            ])
            ->add('imageFile', FileType::class, [
                "required" => false,
                'data_class' => null
            ])
            ->add('comment', TextareaType::class, [
                "label" => "Remarques",
                "required" => false
            ])
            ->add('author', EntityType::class, [
                'class' => Salesperson::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.lastName', 'ASC');
                },
                "label" => "Auteur",
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Operations::class,
        ]);
    }
}
