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
            $carrito = $session->get('carrito', []);

            if (isset($carrito[$producto->getId()])) {
                $carrito[$producto->getId()]['cantidad'] += 1;
            } else {
                $carrito[$producto->getId()] = [
                    'producto' => $producto,
                    'cantidad' => 1,
                ];
            }

            $session->set('carrito', $carrito);
        } else {
            // Usuario autenticado: persistimos en la base de datos
            $usuario = $this->getUser();

            $carritoExistente = $em->getRepository(Carrito::class)->findOneBy([
                'usuario' => $usuario,
                'producto' => $producto,
            ]);

            if ($carritoExistente) {
                $carritoExistente->setCantidad($carritoExistente->getCantidad() + 1);
            } else {
                $carrito = new Carrito();
                $carrito->setUsuario($usuario)
                    ->setProducto($producto)
                    ->setCantidad(1);
                $em->persist($carrito);
            }

            $em->flush();
        }

        return $this->redirectToRoute('app_carrito');
    }

    #[Route('/carrito', name: 'app_carrito')]
    public function carrito(EntityManagerInterface $em, Request $request): Response
    {
        $usuario = $this->getUser();
        $carrito = [];

        if ($usuario) {
            // Obtenemos los productos del carrito de la base de datos
            $carrito = $em->getRepository(Carrito::class)->findBy(['usuario' => $usuario]);
        } else {
            // Obtenemos los productos del carrito almacenados en la sesión
            $session = $request->getSession();
            $carritoSesion = $session->get('carrito', []);
            
            foreach ($carritoSesion as $item) {
                $carrito[] = (object)[
                    'producto' => $item['producto'],
                    'cantidad' => $item['cantidad'],
                ];
            }
        }

        return $this->render('carrito/index.html.twig', [
            'carrito' => $carrito,
            'usuarioAutenticado' => $usuario !== null,
        ]);
    }
}
