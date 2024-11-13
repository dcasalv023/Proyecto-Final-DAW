<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductosController extends AbstractController
{
    #[Route("/productos", name: "app_productos")]
    public function lista(): Response
    {
        return $this->render('productos/lista.html.twig');
    }
}
