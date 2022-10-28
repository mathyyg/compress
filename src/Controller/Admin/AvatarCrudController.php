<?php

namespace App\Controller\Admin;

use App\Entity\Avatar;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class AvatarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Avatar::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('name', 'Image')
            ->hideOnForm()
            ->setBasePath('/avatar')
            ->setUploadDir('public/avatar'),
            Field::new('file')->setFormType(VichImageType::class)->hideOnIndex(),
            AssociationField::new('user')->setCrudController(UserCrudController::class)->hideWhenUpdating(),
            IntegerField::new('size')->hideOnForm(),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
        
        ;
    }
    
}
