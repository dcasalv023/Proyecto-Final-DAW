<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListaDeseosController extends AbstractController
{
    #[Route('/lista/deseos', name: 'app_lista_deseos')]
    public function index(): Response
    {
        return $this->render('lista_deseos/index.html.twig', [
            'controller_name' => 'ListaDeseosController',
        ]);
    }
}
