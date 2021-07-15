<?php

namespace App\Controller\Admin;

use App\Entity\Hebergement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class HebergementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hebergement::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            BooleanField::new('hebSeul'),
            BooleanField::new('petitDej'),
            BooleanField::new('demiPension'),
            BooleanField::new('pensionComplete'),
            ImageField::new('photo')->setBasePath('uploads/hebergement/')
                ->setUploadDir('public/uploads/hebergement/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            AssociationField::new('voyage'),
        ];
    }

}
