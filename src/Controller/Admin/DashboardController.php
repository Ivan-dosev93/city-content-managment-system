<?php

namespace App\Controller\Admin;

use App\Entity\BlogCategory;
use App\Entity\BlogPost;
use App\Entity\Business;
use App\Entity\Contact;
use App\Entity\HeaderMenuItem;
use App\Entity\HomepageSlider;
use App\Entity\Job;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
//        return parent::index();

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(BlogPostCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Админ панел');
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section("Секция блог")->setPermission('ROLE_BLOG_REDACTOR');
        yield MenuItem::linkToCrud('Блог статии', 'fa fa-commenting', BlogPost::class)->setPermission('ROLE_BLOG_REDACTOR');
        yield MenuItem::linkToCrud('Блог категории', 'fa fa-commenting-o', BlogCategory::class)->setPermission('ROLE_BLOG_REDACTOR');
        yield MenuItem::section("Начална страница")->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Слайдер', 'fa fa-file-image-o', HomepageSlider::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Меню', 'fa fa-file-image-o', HeaderMenuItem::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::section("Секция контакти")->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Контакти', 'fa fa-file-image-o', Contact::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::section("Секция потребители")->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Потребители', 'fa fa-user', User::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::section("Секция бизнес")->setPermission('ROLE_BUSINESS_REDACTOR');
        yield MenuItem::linkToCrud('Бизнеси', 'fas fa-business-time', Business::class)->setPermission('ROLE_BUSINESS_REDACTOR');
//        yield MenuItem::linkToCrud('Работни позиции', 'fas fa-tasks', Job::class)->setPermission('ROLE_BUSINESS_REDACTOR');
    }
}
