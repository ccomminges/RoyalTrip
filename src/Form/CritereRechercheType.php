<?php

namespace App\Form;

use App\Classe\CritereRecherche;
use App\Entity\Destination;
use App\Entity\Formule;
use App\Entity\Hebergement;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CritereRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string',TextType::class , [
                'label'=>false,
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'Entrer vos critères de recherche ...',
                    'class'=>'inputRecherche'
                ]
            ])
         /*  ->add('destinations', EntityType::class, [
                'label'=>false,
                'required'=>false,
                'class'=>Destination::class,
                'multiple'=>true,
                'expanded'=>false,
                'attr'=>[
                    'class'=>'divCritere'
                ]
            ]) */
            ->add('submitRecherche',SubmitType::class,[
                'label'=>'Filtrer',
                'attr'=>[
                    'class'=>'btn btn-success',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CritereRecherche::class,
            'method' => 'GET',
            'crsf_protection' => false,  /* Désactivation de la protection et des sécurité (cryptage) pour le form */
        ]);
    }


    //Pour pas que l'url appelle un tableau parent
    public function getBlockPrefix()
    {
        //return parent::getBlockPrefix(); // TODO: Change the autogenerated stub
        return '';
    }

}
