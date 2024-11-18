<?php

namespace App\Controller\Admin;

use App\Entity\Categoria;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CategoriaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categoria::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Campo ID (solo en las páginas de detalle y lista)
            IdField::new('id')->hideOnForm(),

            // Campo para el nombre de la categoría
            TextField::new('name', 'Name'),

            // Campo para la descripción
            TextEditorField::new('description', 'Description'),

            // Campo para ver la relación con productos, solo en el listado y detalle
            AssociationField::new('productos', 'Productos')
                ->onlyOnDetail(),
        ];
    }
}
