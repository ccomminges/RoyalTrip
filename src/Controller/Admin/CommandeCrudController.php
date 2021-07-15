<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TimeField::new('heureRDV'),
            DateField::new('dateRDV'),
            BooleanField::new('rdvPresentiel'),
            DateField::new('dateCreation'),
            ChoiceField::new('etat')->setChoices([
                'En attente'=>0,
                'En cours de traitement'=>1,
                'Accepté'=>2,
                'Refusé'=>3
            ]),
            TextField::new('reference'),
            TextField::new('stripeSessionId'),
            AssociationField::new('client'),

        ];
    }

}
