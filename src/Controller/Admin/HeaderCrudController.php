<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre','titre du header'),
            TextareaField::new('contenu',"phrase d'accroche"),
            TextField::new('btn1Titre','Titre du bouton circuit'),
            TextField::new('btn1Titre','Url du bouton circuit'),
            TextField::new('btn2Titre','Titre du bouton contact'),
            TextField::new('btn2Titre','Url du bouton contact'),
            ImageField::new('illustration')->setBasePath('uploads/')
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }

}
