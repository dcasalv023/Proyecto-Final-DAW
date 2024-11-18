<?php

namespace App\Controller\Admin;

use App\Entity\ListaDeseos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ListaDeseosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ListaDeseos::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('usuario', 'Usuario')
                ->setCrudController(UsuarioCrudController::class),
            AssociationField::new('productos', 'Productos')
                ->setCrudController(ProductoCrudController::class)
                ->setFormTypeOption('by_reference', false),
        ];
    }
}
