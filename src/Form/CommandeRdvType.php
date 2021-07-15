<?php

namespace App\Form;

use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeRdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user=$options['user'];

        $builder
            ->add('heureRdv',TimeType::class, [
                    'label'=> "Heure du rendez-vous "
                ]
            )
            ->add('dateRdv',DateType::class, [
                    'label'=> "Date du rendez-vous "
                ]
            )
            ->add('rdvPresentiel',ChoiceType::class, [
                    'choices'=>[
                        'Distanciel'=>0,
                        'Presentiel'=>1
                    ],
                    'label'=> "Présentiel ou distanciel"
                ]
            )
            ->add('submitCommandeRdv',SubmitType::class,[
                'label'=>'Valider la date de rendez-vous',
                'attr'=>[
                    'class'=>'btn btn-success',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user'=>array()
        ]);
    }
}
