<?php

namespace App\Controller\Admin;

use App\Entity\Producto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ProductoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Producto::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Name', 'Name'),
            TextField::new('Description', 'Descripción'),
            MoneyField::new('price', 'Precio')->setCurrency('EUR'),
            IntegerField::new('Stock', 'Stock'),
            ImageField::new('imagenUrl', 'Imagen')
                // Asegurarte de que el archivo se sube a la carpeta correcta
                ->setBasePath('uploads/images') // Esto es la ruta base que el navegador usará
                ->setUploadDir('public/uploads/images') // Esto define el directorio en el servidor
                ->setRequired(false), // Si la imagen no es obligatoria
            AssociationField::new('categoria', 'Categoría')
        ];
    }
}
