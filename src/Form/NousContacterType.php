<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NousContacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class ,[
                'attr'=>[
                    'label'=>false,
                    'placeholder'=> 'Merci de saisir votre nom',
                    'class'=>'form-control'
                ]
            ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    'label'=>false,
                    'placeholder'=> 'Merci de saisir votre email',
                    'class'=>'form-control'
                ]
            ])
            ->add('telephone',TextType::class,[
                'attr'=>[
                    'label'=>false,
                    'placeholder'=> 'Merci de saisir votre numero de telephone',
                    'class'=>'form-control'
                ]
            ])
            ->add('content',TextareaType::class,[
                'attr'=>[
                    'placeholder'=> 'Merci de saisir votre message',
                    'class'=>'form-control',
                    'rows'=>15
                ]
            ])
            ->add('submitContact',SubmitType::class,[
                'label'=>'Envoyer',
                'attr'=>[
                    'class'=> 'btn-block btn-success'
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
