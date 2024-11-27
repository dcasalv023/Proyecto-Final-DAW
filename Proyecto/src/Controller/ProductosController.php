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

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/productos", name: "app_productos")]
    public function lista(Request $request): Response
    {
        $categoriaId = $request->query->get('categoria');
        $precio = $request->query->get('precio'); // Precio máximo seleccionado

        $queryBuilder = $this->entityManager->getRepository(Producto::class)->createQueryBuilder('p');

        // Filtrar por categoría
        if ($categoriaId) {
            $queryBuilder->andWhere('p.categoria = :categoria')
                        ->setParameter('categoria', $categoriaId);
        }

        // Filtrar por precio
        if ($precio) {
            $queryBuilder->andWhere('p.price <= :precio')
                         ->setParameter('precio', $precio * 100); // Convertimos a centavos
        }

        $productos = $queryBuilder->getQuery()->getResult();

        // Consultar precios mínimo y máximo de todos los productos
        $priceStats = $this->entityManager->getRepository(Producto::class)
            ->createQueryBuilder('p')
            ->select('MIN(p.price) AS minPrice, MAX(p.price) AS maxPrice')
            ->getQuery()
            ->getSingleResult();

        $minPrice = $priceStats['minPrice'] / 100; // Convertir de centavos a euros
        $maxPrice = $priceStats['maxPrice'] / 100;

        $categorias = $this->entityManager->getRepository(Categoria::class)->findAll();

        return $this->render('productos/lista.html.twig', [
            'productos' => $productos,
            'categorias' => $categorias,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }

    #[Route("/producto/{id}", name: "app_producto_detalle")]
    public function detalle(int $id): Response
    {
        $producto = $this->entityManager->getRepository(Producto::class)->find($id);

        if (!$producto) {
            throw $this->createNotFoundException('Producto no encontrado');
        }

        return $this->render('productos/producto.html.twig', [
            'producto' => $producto,
        ]);
    }
}
