<?php

// src/Controller/ErrorController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Throwable;

class ErrorController extends AbstractController
{
    /**
     * Muestra la página de acceso denegado (error 403).
     */
    public function accesoDenegado(Throwable $exception): Response
    {
        // Verificamos si la excepción es de acceso denegado
        if ($exception instanceof AccessDeniedHttpException) {
            return $this->render('error/acceso_denegado.html.twig');
        }

        // En este caso, no queremos manejar otros errores, solo el acceso denegado.
        // Symfony ya maneja otros errores, no es necesario renderizar otra vista.
        return new Response('', 500);  // Podrías devolver una respuesta vacía o dejar que Symfony maneje el error.
    }
}



