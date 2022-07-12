<?php

namespace App\Form;

use App\Entity\Collaborateurs;
use App\Entity\Competences;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CompetenceCollaborateurType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('competence_principale', EntityType::class, [
                'class' => Competences::class,
                'label' => 'Compétence Principale *',
                'choice_label' => 'technologie',
                'placeholder' => 'Compétence Principale',
                'mapped' => false,
                'required' => true,
            ])
            ->add('competence_secondaire', EntityType::class, [
                'class' => Competences::class,
                'label' => 'Compétence Secondaire',
                'choice_label' => 'technologie',
                'placeholder' => 'Compétence Secondaire',
                'mapped' => false,
                'required' => false,
            ])
            ->add('competence_terciere', EntityType::class, [
                'class' => Competences::class,
                'label' => 'Compétence Tercière',
                'choice_label' => 'technologie',
                'placeholder' => 'Compétence Tercière',
                'mapped' => false,
                'required' => false,
            ])
            ->add('ajouter', SubmitType::class, [
                'label' => 'Ajouter',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collaborateurs::class,
        ]);
    }
}
