<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comment;
use App\Entity\Conference;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Guestbook');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
				// yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
				// links to the 'index' action of the Comments CRUD controller
        yield MenuItem::linkToCrud('Comments', 'fa fa-comments', Comment::class);
        yield MenuItem::linkToCrud('Conferences', 'fa fa-users', Conference::class);
    }
}
