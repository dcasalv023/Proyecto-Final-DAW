<?php

namespace App\Form;

use App\Entity\DetalleOrden;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Producto;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetalleOrdenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('producto', EntityType::class, [
                'class' => Producto::class,
                'choice_label' => 'name',
                'label' => 'Producto',
            ])
            ->add('Cantidad', IntegerType::class, [  // Cambié 'cantidad' a 'Cantidad'
                'label' => 'Cantidad',
            ])
            ->add('precioUnitario', MoneyType::class, [  // Cambié 'precio' a 'precioUnitario'
                'currency' => 'USD',
                'label' => 'Precio',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetalleOrden::class,
        ]);
    }
}
