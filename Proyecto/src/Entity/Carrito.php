<?php

namespace App\Entity;

use App\Repository\CarritoRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CarritoRepository::class)]
class Carrito
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    // Relación muchos a uno con Usuario
    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'carritos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    // Relación muchos a muchos con Producto
    #[ORM\ManyToMany(targetEntity: Producto::class, inversedBy: 'carritos')]
    private Collection $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    // Método getUsuario
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    // Método setUsuario
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
