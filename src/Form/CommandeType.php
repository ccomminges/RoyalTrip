<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $user=$options['user'];

        $builder
            ->add('NbPersPlus12',IntegerType::class, [
                'label'=> "Nombre de place réservé pour des personnes de plus de 12 ans :"
                ]
            )
            ->add('NbPersMoins12',IntegerType::class, [
                    'label'=> "Nombre de place réservé pour des personnes de moins de 12 ans :"
                ]
            )
            ->add('submitCommande',SubmitType::class,[
                'label'=>'Valider les informations de la commande',
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
