<?php

namespace App\Controller;

use App\Entity\Producto;
use Doctrine\ORM\EntityManagerInterface;
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

    // Ruta para ver los detalles de un producto específico
    #[Route("/producto/{id}", name: "app_producto_detalle")]
    public function detalle(int $id): Response
    {
        // Buscar el producto por su ID
        $producto = $this->entityManager
            ->getRepository(Producto::class)
            ->find($id);

        // Si no se encuentra el producto, lanzar un error 404
        if (!$producto) {
            throw $this->createNotFoundException('Producto no encontrado');
        }

        // Renderizar la plantilla de detalles y pasar el producto
        return $this->render('productos/producto.html.twig', [
            'producto' => $producto,
        ]);
    }
}

