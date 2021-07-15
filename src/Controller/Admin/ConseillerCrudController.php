<?php

namespace App\Controller\Admin;

use App\Entity\Conseiller;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ConseillerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Conseiller::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
           // TextField::new('roles'),
            TextField::new('password'),
            TextField::new('nom'),
            TextField::new('prenom'),
            TelephoneField::new('telephone'),
            TextareaField::new('questionnaire')

        ];
    }

}
