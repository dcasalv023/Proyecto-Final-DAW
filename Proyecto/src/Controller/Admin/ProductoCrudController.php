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
            IdField::new('id')->hideOnForm(), // El ID no debe ser editable
            TextField::new('Name', 'Name'),
            TextField::new('Description', 'Descripción'),
            MoneyField::new('Price', 'Precio')->setCurrency('USD'),
            IntegerField::new('Stock', 'Stock'),
            ImageField::new('imagenUrl', 'Imagen')
                ->setBasePath('/assets/images') // Definir la carpeta base para las imágenes
                ->setUploadDir('public/build/images') // Definir el directorio para subir imágenes
                ->setRequired(false),
            AssociationField::new('categoria', 'Categoría') // Relación con la entidad Categoria
        ];
    }
}
