<?php

namespace App\Controller\Admin;

use App\Entity\Dossier;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class DossierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dossier::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('dateCreation'),
            DateField::new('dateLimite'),
            ChoiceField::new('statutDossier')->setChoices([
                'En attente'=>0,
                'En cours de traitement'=>1,
                'Accepté'=>2,
                'Refusé'=>3
            ]),
            IntegerField::new('nbPlaceReserve'),
            BooleanField::new('annulation'),
            AssociationField::new('client'),
        ];
    }

}
