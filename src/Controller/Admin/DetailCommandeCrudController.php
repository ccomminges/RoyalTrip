<?php

namespace App\Controller\Admin;

use App\Entity\DetailCommande;
use Doctrine\DBAL\Types\FloatType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DetailCommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DetailCommande::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('voyageNom'),
            IntegerField::new('quantite'),
            IntegerField::new('NbPersPlus12'),
            IntegerField::new('NbPersMoins12'),
            NumberField::new('prix'),
            NumberField::new('ReductionMoins12'),
            NumberField::new('total'),
            AssociationField::new('commande'),

        ];
    }

}
