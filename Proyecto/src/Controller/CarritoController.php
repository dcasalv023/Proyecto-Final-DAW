<?php

namespace App\Controller;

use App\Entity\Carrito;
use App\Entity\Producto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarritoController extends AbstractController
{
    #[Route('/carrito/agregar/{id}', name: 'app_carrito_agregar')]
    public function agregar(
        Producto $producto,
        EntityManagerInterface $em,
        Request $request
    ): RedirectResponse {
        // Si el usuario no está autenticado, usamos la sesión
        $session = $request->getSession();

        if (!$this->getUser()) {
            // Obtenemos el carrito de la sesión
            $carrito = $session->get('carrito', []);

            if (isset($carrito[$producto->getId()])) {
                // Si el producto ya está en el carrito, aumentamos la cantidad
                $carrito[$producto->getId()]['cantidad'] += 1;
            } else {
                // Si el producto no está en el carrito, lo agregamos
                $carrito[$producto->getId()] = [
                    'producto' => $producto,
                    'cantidad' => 1,
                ];
            }

            // Guardamos el carrito en la sesión
            $session->set('carrito', $carrito);
        } else {
            // Usuario autenticado: persistimos en la base de datos
            $usuario = $this->getUser();

            // Buscamos si el producto ya está en el carrito
            $carritoExistente = $em->getRepository(Carrito::class)->findOneBy([
                'usuario' => $usuario,
                'producto' => $producto,
            ]);

            if ($carritoExistente) {
                // Si el producto ya está, aumentamos la cantidad
                $carritoExistente->setCantidad($carritoExistente->getCantidad() + 1);
            } else {
                // Si el producto no está en el carrito, lo creamos
                $carrito = new Carrito();
                $carrito->setUsuario($usuario)
                    ->setProducto($producto)
                    ->setCantidad(1);
                $em->persist($carrito);
            }

            // Guardamos los cambios en la base de datos
            $em->flush();
        }

        // Redirigimos al carrito
        return $this->redirectToRoute('app_carrito');
    }

    #[Route('/carrito', name: 'app_carrito')]
    public function carrito(EntityManagerInterface $em, Request $request): Response
    {
        $usuario = $this->getUser();
        $carrito = [];
        $totalCarrito = 0; // Variable para almacenar el total del carrito

        if ($usuario) {
            // Obtenemos los productos del carrito de la base de datos
            $carrito = $em->getRepository(Carrito::class)->findBy(['usuario' => $usuario]);

            // Calcular el total del carrito
            foreach ($carrito as $item) {
                $totalCarrito += $item->getProducto()->getPrice() * $item->getCantidad();
            }
        } else {
            // Obtenemos los productos del carrito almacenados en la sesión
            $session = $request->getSession();
            $carritoSesion = $session->get('carrito', []);

            // Construimos los productos y calculamos el total
            foreach ($carritoSesion as $item) {
                $carrito[] = (object)[
                    'producto' => $item['producto'],
                    'cantidad' => $item['cantidad'],
                ];

                // Calcular el total
                $totalCarrito += $item['producto']->getPrice() * $item['cantidad'];
            }
        }

        // Pasamos el carrito y el total a la vista
        return $this->render('carrito/index.html.twig', [
            'carrito' => $carrito,
            'usuarioAutenticado' => $usuario !== null,
            'totalCarrito' => $totalCarrito, // Pasamos el total al Twig
        ]);
    }

    #[Route('/carrito/eliminar/{id}', name: 'app_carrito_eliminar')]
public function eliminar(
    $id, 
    EntityManagerInterface $em, 
    Request $request
): RedirectResponse {
    $usuario = $this->getUser();
    $session = $request->getSession();

    if ($usuario) {
        // Si el usuario está autenticado, eliminamos el producto de la base de datos
        $carritoExistente = $em->getRepository(Carrito::class)->findOneBy([
            'usuario' => $usuario,
            'producto' => $id,
        ]);

        if ($carritoExistente) {
            $em->remove($carritoExistente);
            $em->flush();
        }
    } else {
        // Si el usuario no está autenticado, eliminamos el producto de la sesión
        $carrito = $session->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            $session->set('carrito', $carrito);
        }
    }

    return $this->redirectToRoute('app_carrito');
}

}

