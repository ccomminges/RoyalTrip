<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        ///VOIR LES constraints
        $builder
            ->add('prenom',TextType::class , ['label'=> 'Votre prénom :',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>30
                ]),
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre prénom',
                ]
            ])
            ->add('nom', TextType::class, ['label'=> 'Votre nom :',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>30
                ]),
                'attr'=>[ 'placeholder'=>'Merci de saisir votre nom' ]
            ])
            ->add('email', EmailType::class, ['label'=> 'Votre email :',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>60
                ]),
                'attr'=>[ 'placeholder'=>'Merci de saisir votre email' ]
            ])
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>"Le mot de passe et la confirmation doivent être identique",
                'label'=> 'Votre mot de passe',
                'required'=>true,
                'first_options'=>[ 'label'=>'Mot de passe :',
                    'attr'=>[
                        'placeholder'=>'Merci de saisir votre mot de passe'
                    ]
                ],
                'second_options'=>[ 'label'=>'Confirmer le mot de passe :',
                    'attr'=>[
                        'placeholder'=>'Merci de confirmer votre mot de passe'
                    ]
                ],

            ])

            ->add('age',IntegerType::class , ['label'=> 'Votre age :',
                'attr'=>[
                    'class'=>'ageCreationCompte',
                    'placeholder'=>'Votre age'
                ]
            ])
            ->add('civilite',ChoiceType::class , [
                'choices'=>[
                    'M'=>'Masculin',
                    'F'=>'Feminin'
                ],
                'label'=> 'Votre sexe (M ou F)',
                'attr'=>[
                    'class'=>'civiliteCreationCompte'
                ]
            ])
            ->add('adresse',TextType::class,
                [
                    'label'=>"Votre adresse postale :",
                    'attr'=>[
                        'placeholder'=> "Entrer adresse postale",
                    ]
                ])
            ->add('telephone',TelType::class , ['label'=> 'Votre numéro :',
                'attr'=>[ 'placeholder'=>'Merci de saisir votre numéro' ]
            ])
            ->add('dateNaissance',DateType::class , ['label'=> 'Votre date de naissance :',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y')-100),
                'attr'=>[ 'class'=>'dateCreationCompte' ]
            ])

            ->add( 'submit', SubmitType::class,['label' => "S'inscrire",
                'attr'=>[
                'class'=>'btn-inscription btn-success',
                ]
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Client::class
        ]);
    }
}
