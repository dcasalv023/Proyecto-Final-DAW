<?php

namespace App\Controller\Admin;

use App\Entity\DetalleOrden;
use App\Entity\Orden;
use App\Entity\Producto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class DetalleOrdenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DetalleOrden::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('orden', 'Orden')
                ->setCrudController(OrdenCrudController::class)
                ->setRequired(true), // Asociar un detalle a una orden existente
            AssociationField::new('producto', 'Producto')
                ->setCrudController(ProductoCrudController::class)
                ->setRequired(true), // Asociar un producto
            IntegerField::new('cantidad', 'Cantidad'),
            MoneyField::new('precioUnitario', 'Precio Unitario')
                ->setCurrency('USD'),
        ];
    }
}
