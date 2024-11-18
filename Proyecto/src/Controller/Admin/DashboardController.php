<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Producto;
use App\Entity\Categoria;
use App\Entity\Orden;
use App\Entity\DetalleOrden;
use App\Entity\ListaDeseos;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        
        $adminUrlGenerator = $this->container->get(\EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductoCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Proyecto'); 
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Productos', 'fas fa-box', Producto::class);
        yield MenuItem::linkToCrud('Categorías', 'fas fa-tags', Categoria::class);
        yield MenuItem::linkToCrud('Órdenes', 'fas fa-shopping-cart', Orden::class);
        yield MenuItem::linkToCrud('Detalles de Orden', 'fas fa-list', DetalleOrden::class); 
        yield MenuItem::linkToCrud('Listas de Deseos', 'fas fa-heart', ListaDeseos::class);
    }
}
