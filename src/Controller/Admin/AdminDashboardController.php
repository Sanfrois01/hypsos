<?php

namespace App\Controller\Admin;

use App\Entity\Gerant;
use App\Entity\Hotel;
use App\Entity\Suite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class AdminDashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator 
    ) {
        
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $url = $this->adminUrlGenerator
            ->setController(GerantCrudController::class)
            ->setController(HotelCrudController::class)
            ->setController(SuiteCrudController::class)
            ->generateUrl();

        $url2 = $this->adminUrlGenerator
        ->setController(SuiteCrudController::class);

        return $this->redirect($url);

        if ('gerant' === $this->getUser()->getUserIdentifier()){
            return $this->redirect($url2);
        }

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hypsos');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Gestion des Hotels');

        yield MenuItem::subMenu('Action', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter un Hotel', 'fas fa-plus',Hotel::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir la listes des Hotels', 'fas fa-eye',Hotel::class)



        ]);


        yield MenuItem::section('Gestion des Gerants');

        yield MenuItem::subMenu('Action', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter un Gérant', 'fas fa-plus',Gerant::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir la listes des Gérants', 'fas fa-eye',Gerant::class)

        ]);

        yield MenuItem::section('Gestion des Suites');

        yield MenuItem::subMenu('Action', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter une suites', 'fas fa-plus',Suite::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir la listes des suites', 'fas fa-eye',Suite::class)

        ]);





        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
