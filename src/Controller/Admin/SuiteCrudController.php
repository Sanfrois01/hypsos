<?php

namespace App\Controller\Admin;

use App\Entity\Suite;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SuiteCrudController extends AbstractCrudController

{
    public const SUITE_BASE_PATH = 'upload/images/suites';
    public const SUITE_UPLOAD_DIR = 'public/upload/images/suites';
    public static function getEntityFqcn(): string
    {
        return Suite::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            ImageField::new('image')
            ->setBasePath(self::SUITE_BASE_PATH)
            ->setUploadDir(self::SUITE_UPLOAD_DIR),
            TextEditorField::new('description'),
            MoneyField::new('prix')->setCurrency('EUR')

        ];
    }
    
}
