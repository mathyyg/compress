<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Resource;
use App\Entity\Utilisation;
use App\Entity\Fichier;
use App\Entity\Link;
use App\Entity\Avatar;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;


class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator){

    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return $this->configureDashboard()::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        
        return $this->redirect($this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

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
            ->setTitle('Compress');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Resource', 'fa fa-cubes', Resource::class);
        yield MenuItem::linkToCrud('Utilisation', 'fa fa-arrow-up', Utilisation::class);
        yield MenuItem::linkToCrud('Link', 'fa fa-link', Link::class);
        yield MenuItem::linkToCrud('File', 'fa fa-file', Fichier::class);
        yield MenuItem::linkToCrud('Avatar', 'fa fa-picture-o', Avatar::class);
        yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
