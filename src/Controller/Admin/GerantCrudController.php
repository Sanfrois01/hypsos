<?php

namespace App\Controller\Admin;

use App\Entity\Gerant;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GerantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gerant::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('username'),
            TextField::new('password'),
            TextField::new('email'),
            AssociationField::new('hotel')



        ];
    }
    
}
