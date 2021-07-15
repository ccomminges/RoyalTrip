<?php

namespace App\Controller\Admin;

use App\Entity\Participants;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ParticipantsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Participants::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('nom'),
           TextField::new('prenom'),
           IntegerField::new('age'),
            ChoiceField::new('civilite')->setChoices([
                'Feminin'=>'F',
                'Masculin'=>'M'
            ]),
            TextField::new('adresse'),
            TelephoneField::new('telephone'),
            DateField::new('dateNaissance'),
            AssociationField::new('conseiller'),
            AssociationField::new('dossier'),

        ];
    }

}
