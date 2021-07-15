<?php

namespace App\Form;

use Doctrine\ORM\Mapping\Id;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ClientProfilModifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           /* ->add('id', IntegerType::class, ['label'=> "Votre numéro d'identification ",
                'mapped' => false,
                'attr'=>[
                    'disabled'=>'disabled'
                ]
            ]) */
            ->add('civilite',ChoiceType::class , [
                'choices'=>[
                    'M'=>'Masculin',
                    'F'=>'Feminin'
                ],
                'label'=> 'Civilité',
                'attr'=>[
                    'class'=>'civiliteDnCreationCompte'
                ]
            ])
            ->add('nom', TextType::class, ['label'=> 'Nom ',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>30
                ])
            ])
            ->add('prenom',TextType::class , ['label'=> 'Prénom ',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>30
                ])
            ])
            ->add('dateNaissance',DateType::class , ['label'=> 'Date de naissance ',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y')-100),

                'attr'=>[
                    'class'=>'civiliteDnCreationCompte'
                ]
            ])
            ->add('adresse',TextType::class,
                [
                    'label'=>"Adresse ",
                ])
            ->add('telephone',TelType::class , ['label'=> 'Téléphone :'
            ])
            ->add('email', EmailType::class, ['label'=> 'Email :',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>60
                ]),
            ])
            ->add('password', PasswordType::class, ['label'=> 'Mot de passe ',
                'constraints'=>new Length([
                    'min'=>2,
                    'max'=>30
                ]),
            ])
            ->add('submitModifProfil',SubmitType::class,[
                'label'=>'Modifier',
                'attr'=>[
                    'class'=>'btn btn-success',
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
