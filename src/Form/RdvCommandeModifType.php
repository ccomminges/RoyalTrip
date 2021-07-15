<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RdvCommandeModifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heureRdv',TimeType::class, [
                    'label'=> "Heure du rendez-vous ",
                    'attr'=>[
                        'class'=>'inputModifRdv'
                    ]
                ]
            )
            ->add('dateRdv',DateType::class, [
                    'label'=> "Date du rendez-vous ",

                    'attr'=>[
                        'class'=>'inputModifRdv'
                    ]
                ]
            )
            ->add('rdvPresentiel',ChoiceType::class, [
                    'choices'=>[
                        'Distanciel'=>0,
                        'Presentiel'=>1
                    ],
                    'label'=> "Présentiel ou distanciel",
                    'attr'=>[
                        'class'=>'inputModifRdv'
                    ]

                ]
            )
            ->add('submitModifCommandeRdv',SubmitType::class,[
                'label'=>'Modifier les modalités du rendez-vous',
                'attr'=>[
                    'class'=>'btn btn-success',
                    'id'=>'btnModifRdv'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
