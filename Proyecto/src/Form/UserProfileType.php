<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Correo Electrónico',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Guardar Cambios',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }
}
