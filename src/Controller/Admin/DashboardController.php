<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            ->setTitle('Guestbook')
            ->setTitle('<img src="images/images.jpeg" style="width:100px" class="rounded img-thumbnail" title="Guestbook"/> Guestbook ')
            ->setFaviconPath('favicon.ico')
            ->setTranslationDomain('knlb-domain')
            ->setTextDirection('ltr')
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Comment::class)
            ->setQueryParameter('sortField', 'createdAt')
            ->setQueryParameter('sortDirection', 'DESC')
        ;
        yield MenuItem::linkToCrud('Conférences', 'fas fa-tags', Conference::class);
        //yield MenuItem::linkToLogout('Logout', 'fa fa-exit');
    }
}
