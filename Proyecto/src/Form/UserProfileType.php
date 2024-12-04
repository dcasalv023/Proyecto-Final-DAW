<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;

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
            // Agregar campo para la imagen de perfil (opcional)
            ->add('imagePerfil', FileType::class, [
                'label' => 'Foto de perfil (opcional)',
                'required' => false, // Lo hacemos opcional
                'mapped' => false, // No se mapea directamente a la entidad
                'attr' => ['accept' => 'image/*'], // Acepta solo imágenes
                'constraints' => [
                    new File([
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Por favor, sube una imagen válida (JPEG o PNG)',
                    ])
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Guardar Cambios',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }
}


