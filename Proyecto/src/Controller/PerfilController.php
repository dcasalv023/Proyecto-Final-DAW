<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UserProfileType;
use App\Entity\Usuario;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class PerfilController extends AbstractController
{
    #[Route('/perfil', name: 'app_perfil')]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('perfil/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/perfil/editar', name: 'edit_profile')]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(UserProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imagePerfil')->getData();
            if ($imageFile) {
                $filename = uniqid().'.'.$imageFile->guessExtension();

                // Mover el archivo a un directorio de la aplicación
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'), // Asegúrate de definir este parámetro en `services.yaml`
                        $filename
                    );
                } catch (IOExceptionInterface $exception) {
                    $this->addFlash('error', 'Hubo un error al guardar la imagen.');
                }

                // Establecer la ruta de la imagen en la entidad
                $user->setImagePerfil($filename);
            }

            // Guardar cambios
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Perfil actualizado con éxito.');
            return $this->redirectToRoute('app_perfil');
        }

        return $this->render('perfil/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/perfil/eliminar', name: 'delete_profile')]
    public function delete(EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Cuenta eliminada con éxito.');

        return $this->redirectToRoute('app_home');
    }
}
