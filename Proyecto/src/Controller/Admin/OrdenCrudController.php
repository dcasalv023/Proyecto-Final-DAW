<?php

namespace App\Controller\Admin;

use App\Entity\Orden;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Form\DetalleOrdenType;

class OrdenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Orden::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('Date', 'Fecha de Orden')
                ->setFormat('yyyy-MM-dd HH:mm:ss'),
            TextField::new('estado', 'Estado'),
            AssociationField::new('usuario', 'Usuario')
                ->setCrudController(UsuarioCrudController::class),
            CollectionField::new('detallesOrden', 'Detalles de la Orden')
                ->setEntryType(DetalleOrdenType::class)
                ->allowAdd(true)
                ->allowDelete(true)
                ->setFormTypeOption('by_reference', false), 
        ];
    }
}
