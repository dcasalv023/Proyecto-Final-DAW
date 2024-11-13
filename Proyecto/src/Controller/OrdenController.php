<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrdenController extends AbstractController
{
    #[Route('/orden', name: 'app_orden')]
    public function index(): Response
    {
        return $this->render('orden/index.html.twig', [
            'controller_name' => 'OrdenController',
        ]);
    }
}
