<?php

namespace App\Form;

use App\Entity\ListaDeseos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Producto;
use App\Entity\Usuario;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListaDeseosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('usuario', EntityType::class, [
                'class' => Usuario::class,
                'choice_label' => 'nombre',
                'label' => 'Usuario',
            ])
            ->add('productos', EntityType::class, [
                'class' => Producto::class,
                'choice_label' => 'nombre',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Productos',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListaDeseos::class,
        ]);
    }
}
