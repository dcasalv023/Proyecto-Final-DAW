<?php

namespace App\Controller;

use App\Entity\Producto;
use Doctrine\ORM\EntityManagerInterface;  // Asegúrate de importar esta clase
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductosController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    // Inyectamos EntityManager en el constructor
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/productos", name: "app_productos")]
    public function lista(): Response
    {
        // Obtener todos los productos desde la base de datos usando el EntityManager
        $productos = $this->entityManager
            ->getRepository(Producto::class)
            ->findAll();

        // Renderizar la plantilla y pasar los productos
        return $this->render('productos/lista.html.twig', [
            'productos' => $productos,
        ]);
    }
}
