<?php

namespace App\Form;

use App\Entity\ChefsProjets;
use App\Entity\Collaborateurs;
use App\Entity\Competences;
use App\Entity\Projets;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('chefs_Projets', EntityType::class, [
                'class' => ChefsProjets::class,
                'label' => 'Chef de projet',
                'choice_label' => 'nom',
                'placeholder' => 'Chef de projet qui s\'occupe du projet',
                'mapped' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('titre', TextType::class, [
                'label' => 'Titre du projet',
            ])
            ->add('description', TextareaType::class, array(
                'label' => 'Description',
                'attr' => array(
                    'rows' => '5',
                    'cols' => '52',
                ),
            ))
            ->add('competences', EntityType::class, [
                'class' => Competences::class,
                'label' => 'Compétence',
                'choice_label' => 'technologie',
                'placeholder' => 'Compétences',
                'mapped' => false,
            ])
            ->add('date_demarrage', DateType::class, array(
                'label' => 'Date de démarrage',
                'widget' => 'single_text',
            ))
            ->add('reste_a_faire', NumberType::class, [
                'label' => 'Reste à faire (en jours)',
            ])
            ->add('charge_vendu', NumberType::class, [
                'label' => 'Charge vendue (en jours)',
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Valider',
            ]);

        $formModifier = function (FormInterface $form, Competences $competences = null) {
            $collaborateurs = null === $competences ? [] : $competences->getCompetencesCollaborateurs();

            $form->add('collaborateurs', EntityType::class, [
                'class' => Collaborateurs::class,
                'placeholder' => 'Sélectionner un/des collaborateur(s)',
                'choice_label' => 'prenom',
                'choices' => $collaborateurs,
            ]);
        };
        
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                
                $formModifier($event->getForm(), $data->getCompetences());
            }
        );

        $builder->get('competences')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $competences = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $competences);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projets::class,
        ]);
    }
}

 //     $formModifier = function (FormInterface $form, Competences $competences = null) {
    //         $collaborateurs = (null === $competences) ? [] : [$competences->getCompetencesCollaborateurs()];

    //         $form->add('collaborateurs', EntityType::class, [
    //             'class' => Collaborateurs::class,
    //             'choices' => $collaborateurs,
    //             'choice_label' => 'prenom',
    //             'placeholder' => 'Sélectionner un collaborateur',
    //             'label' => 'Développeurs',
    //             'multiple' => true,
    //             'mapped' => false,
    //         ]);
    //     };

    //     $builder->get('competences')->addEventListener(
    //         FormEvents::POST_SUBMIT,
    //         function (FormEvent $event) use ($formModifier) {
    //             $competences = $event->getForm()->getData();
    //             $formModifier($event->getForm()->getParent(), $competences);
    //         }
    //     );
    // }
