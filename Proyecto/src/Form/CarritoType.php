<?php
namespace App\Form;

use App\Entity\Carrito;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Producto;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarritoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('producto', EntityType::class, [
                'class' => Producto::class,
                'choice_label' => 'name', // Ajustar según el atributo del producto
                'label' => 'Producto',
            ])
            ->add('cantidad', IntegerType::class, [
                'label' => 'Cantidad',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carrito::class,
        ]);
    }
}
