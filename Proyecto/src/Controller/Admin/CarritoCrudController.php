<?php

namespace App\Controller\Admin;

use App\Entity\Carrito;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class CarritoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carrito::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('usuario', 'Usuario'),
            AssociationField::new('producto', 'Producto'),
            IntegerField::new('cantidad', 'Cantidad'),
        ];
    }
}
