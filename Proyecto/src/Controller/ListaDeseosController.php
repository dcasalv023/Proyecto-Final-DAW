<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListaDeseosController extends AbstractController
{
    #[Route("/lista-deseos", name: "app_deseados")]
    public function ver(): Response
    {
        return $this->render('lista_deseos/ver.html.twig');
    }
}

