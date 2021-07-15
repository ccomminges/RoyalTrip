<?php

namespace App\Controller\Admin;

use App\Entity\Voyage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VoyageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voyage::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('dateDepart'),
            DateField::new('dateRetour'),
            NumberField::new('tarif'),
            NumberField::new('tarifMoins12'),
            IntegerField::new('nbPlace'),
            BooleanField::new('disponibilite'),
            BooleanField::new('assurance'),
            ChoiceField::new('statutVoyage')->setChoices([
                'En attente'=>0,
                'En cours de traitement'=>1,
                'Accepté'=>2,
                'Refusé'=>3
            ]),
            ImageField::new('photo')->setBasePath('uploads/voyage/')
                ->setUploadDir('public/uploads/voyage/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextField::new('nom'),
            IntegerField::new('duree'),
            TextareaField::new('description'),
            TextField::new('reduction'),
            TextareaField::new('aimeParCons'),
            TextareaField::new('servicesPropose'),


        ];
    }

}
