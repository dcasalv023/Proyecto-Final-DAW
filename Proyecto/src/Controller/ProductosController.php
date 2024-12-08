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
        // Obtén los parámetros de filtro
        $categoriaId = $request->query->get('categoria'); // Parámetro para categoría seleccionada
        $precio = $request->query->get('precio'); // Parámetro para rango de precio
        $buscar = $request->query->get('buscar'); // Parámetro de búsqueda por nombre

        // Obtener todas las categorías
        $categorias = $this->entityManager->getRepository(Categoria::class)->findAll();

        // Crear un array para almacenar los productos por categoría
        $productosPorCategoria = [];

        // Crear un queryBuilder base para calcular el rango de precios
        $queryBuilder = $this->entityManager->getRepository(Producto::class)->createQueryBuilder('p');

        // Filtrar por categoría si aplica
        if ($categoriaId) {
            $queryBuilder->andWhere('p.categoria = :categoria')
                         ->setParameter('categoria', $categoriaId);
        }

        // Filtrar por búsqueda de nombre si aplica
        if ($buscar) {
            $queryBuilder->andWhere('p.name LIKE :buscar')
                         ->setParameter('buscar', '%' . $buscar . '%');
        }

        // Obtener los valores mínimo y máximo de precios según los filtros actuales
        $priceStats = $queryBuilder->select('MIN(p.price) AS minPrice, MAX(p.price) AS maxPrice')
                                   ->getQuery()
                                   ->getSingleResult();

        $minPrice = isset($priceStats['minPrice']) ? $priceStats['minPrice'] / 100 : 0; // Convertir de centavos a euros
        $maxPrice = isset($priceStats['maxPrice']) ? $priceStats['maxPrice'] / 100 : 0;

        // Si el filtro de precio está vacío o inválido, usar el rango recalculado
        $precio = $precio ? min($precio, $maxPrice) : $maxPrice;

        // Filtrar por precio si aplica
        if ($precio) {
            $queryBuilder->andWhere('p.price <= :precio')
                         ->setParameter('precio', $precio * 100); // Convertir a centavos
        }

        // Si se selecciona una categoría, obtener los productos de esa categoría
        if ($categoriaId) {
            // Obtener productos de una categoría específica
            $categoria = $this->entityManager->getRepository(Categoria::class)->find($categoriaId);
            if ($categoria) {
                $queryBuilder = $this->entityManager->getRepository(Producto::class)->createQueryBuilder('p');
                $queryBuilder->andWhere('p.categoria = :categoria')
                             ->setParameter('categoria', $categoriaId);

                if ($precio) {
                    $queryBuilder->andWhere('p.price <= :precio')
                                 ->setParameter('precio', $precio * 100); // Convertir a centavos
                }

                if ($buscar) {
                    $queryBuilder->andWhere('p.name LIKE :buscar')
                                 ->setParameter('buscar', '%' . $buscar . '%');
                }

                $productosPorCategoria[$categoria->getName()] = $queryBuilder->getQuery()->getResult();
            }
        } else {
            // Si no se selecciona categoría, mostrar productos organizados por categoría
            foreach ($categorias as $categoria) {
                $queryBuilder = $this->entityManager->getRepository(Producto::class)->createQueryBuilder('p');
                $queryBuilder->andWhere('p.categoria = :categoria')
                             ->setParameter('categoria', $categoria->getId());

                if ($precio) {
                    $queryBuilder->andWhere('p.price <= :precio')
                                 ->setParameter('precio', $precio * 100);
                }

                if ($buscar) {
                    $queryBuilder->andWhere('p.name LIKE :buscar')
                                 ->setParameter('buscar', '%' . $buscar . '%');
                }

                $productosPorCategoria[$categoria->getName()] = $queryBuilder->getQuery()->getResult();
            }
        }

        return $this->render('productos/lista.html.twig', [
            'productosPorCategoria' => $productosPorCategoria, // Productos organizados por categoría
            'categorias' => $categorias,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'selectedCategoria' => $categoriaId, // Enviar la categoría seleccionada al template
            'selectedPrecio' => $precio, // Precio actualmente seleccionado
            'buscar' => $buscar, // Valor de la búsqueda
        ]);
    }

    #[Route("/producto/{id}", name: "app_producto_detalle")]
    public function detalle(int $id): Response
    {
        // Obtener el producto por su ID
        $producto = $this->entityManager->getRepository(Producto::class)->find($id);

        // Si no se encuentra, lanzar una excepción
        if (!$producto) {
            throw $this->createNotFoundException('Producto no encontrado');
        }

        // Renderizar la vista del detalle del producto
        return $this->render('productos/producto.html.twig', [
            'producto' => $producto,
        ]);
    }
}
