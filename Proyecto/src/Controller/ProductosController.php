<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function lista(Request $request): Response
    {
        // Obtener los parámetros de la solicitud (filtros)
        $categoriaId = $request->query->get('categoria');
        $precio = $request->query->get('precio'); // Solo un valor de precio

        // Crear un QueryBuilder para la consulta
        $queryBuilder = $this->entityManager->getRepository(Producto::class)->createQueryBuilder('p');

        // Filtrar por categoría
        if ($categoriaId) {
            $queryBuilder->andWhere('p.categoria = :categoria')
                        ->setParameter('categoria', $categoriaId);
        }

        // Filtrar por precio
        if ($precio) {
            $queryBuilder->andWhere('p.price <= :precio')
                         ->setParameter('precio', $precio * 100); // Convertimos el precio a centavos
        }

        // Ejecutar la consulta
        $productos = $queryBuilder->getQuery()->getResult();

        // Obtener todas las categorías para el filtro
        $categorias = $this->entityManager->getRepository(Categoria::class)->findAll();

        // Renderizar la plantilla y pasar los productos y categorías
        return $this->render('productos/lista.html.twig', [
            'productos' => $productos,
            'categorias' => $categorias,
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
