<?php

// src/Controller/PerfilController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{
    #[Route('/perfil', name: 'app_perfil')]
    public function index(): Response
    {
        // Obtén el usuario autenticado
        $user = $this->getUser();

        // Si el usuario no está autenticado, redirige al inicio de sesión
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Renderiza la plantilla pasando la información del usuario
        return $this->render('perfil/index.html.twig', [
            'user' => $user,
        ]);
    }
}

