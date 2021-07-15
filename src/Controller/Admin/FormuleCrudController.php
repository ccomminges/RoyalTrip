<?php

namespace App\Controller\Admin;

use App\Entity\Formule;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class FormuleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formule::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            BooleanField::new('avion'),
            BooleanField::new('hotel'),
            BooleanField::new('voiture'),
            BooleanField::new('guide'),
            ImageField::new('photo')->setBasePath('uploads/formule/')
                ->setUploadDir('public/uploads/formule/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            AssociationField::new('voyage'),
        ];
    }

}
