<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class HotelCrudController extends AbstractCrudController
{
    public const HOTEL_BASE_PATH = 'upload/images/hotels';
    public const HOTEL_UPLOAD_DIR = 'public/upload/images/hotels';
    public const ACTION_DUPLICATE = 'duplicate';


    public static function getEntityFqcn(): string
    {
        return Hotel::class;
    }

    /*
    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUPLICATE)
            ->linkToCrudAction('duplicateHotel')
            ->setCssClass('btn btn-info');
        
        return $actions
        ->add(Crud::PAGE_EDIT, $duplicate) ;
    }*/

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('ville'),
            TextField::new('adresse'),
            ImageField::new('image')
                ->setBasePath(self::HOTEL_BASE_PATH)
                ->setUploadDir(self::HOTEL_UPLOAD_DIR),
            TextEditorField::new('description'),
            AssociationField::new('gerant')
        ];
    }

   

    public function duplicateHotel(
        AdminContext $context , 
        AdminUrlGenerator $adminUrlGenerator,
        EntityManagerInterface $em
        ): HttpFoundationResponse {
        /** @var Hotel $hotel */
        $hotel = $context->getEntity()->getInstance();

        $duplicatedHotel = clone $hotel;

        parent::persistEntity($em , $duplicatedHotel);

        $url = $adminUrlGenerator->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicatedHotel->getId())
            ->generateUrl();

        return $this->redirect($url);
    }
}
