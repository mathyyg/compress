<?php

namespace App\Controller\Admin;

use App\Entity\Utilisation;
use App\Entity\Resource;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class UtilisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('ip'),
            DateField::new('date'),
            TextField::new('url'),
            AssociationField::new('resource')->setCrudController(ResourceCrudController::class),
        ];
    }

}
