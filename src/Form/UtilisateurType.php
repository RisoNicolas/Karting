<?php

namespace App\Form;

use App\Entity\Utilisateur;

use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options ): void
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('age')
            ->add('categorie')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('telephone')
            ->add('photoProfil')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
