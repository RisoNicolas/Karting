<?php

namespace App\Form;

use App\Entity\Course;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, [
                'label'=>'Nom'
            ])
            ->add('details',TextareaType::class, [
                'label'=>'Details'
            ])
            ->add('dateDeDebut',DateType::class, [
                'html5'=>true,
                'widget'=>'single_text',

            ])
            ->add('dateDeFin',DateType::class, [
                'html5'=>true,
                'widget'=>'single_text',

            ])
            ->add('duree',IntegerType::class, [
                'label'=>'Durée (En jours)'
            ])


            ->add('dateLimiteInscription',DateType::class, [
                'html5'=>true,
                'widget'=>'single_text',

           ])
            ->add('categorie',ChoiceType::class,[
                'choices'=>[
                    'Minimes'=>'Minimes',
                    'Cadet'=>'Cadet',
                    'Nationale'=>'Nationale',
                    'Rotax'=>'Rotax',
                    'X30'=>'X30',
                    'KZ'=>'KZ'
                ]
            ])

            ->add('status',ChoiceType::class,[
                'choices'=>[
                    'Ouverte'=>'Ouverte',
                    'En cours'=>'En cours',
                    'Terminée'=>'Terminee',
                    'Annulée'=>'Annulee'
                ]
            ])
            ->add('backgroundImg')
            ->add('posterImg')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
