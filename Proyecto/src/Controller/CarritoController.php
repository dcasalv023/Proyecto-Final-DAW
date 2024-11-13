<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarritoController extends AbstractController
{
    #[Route("/carrito", name: "app_carrito")]
    public function ver(): Response
    {
        return $this->render('carrito/ver.html.twig');
    }
}
