<?php

namespace App\Entity;

use App\Repository\DetalleOrdenRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


#[ORM\Entity(repositoryClass: DetalleOrdenRepository::class)]
class DetalleOrden
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Cantidad = null;

    #[ORM\Column]
    private ?float $precioUnitario = null;

    // Relación muchos a uno con Orden
    #[ORM\ManyToOne(targetEntity: Orden::class, inversedBy: 'detallesOrden')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Orden $orden = null;

    // Relación muchos a muchos con Producto
    #[ORM\ManyToMany(targetEntity: Producto::class, inversedBy: 'detallesOrden')]
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
        return $this->Cantidad;
    }

    public function setCantidad(int $Cantidad): static
    {
        $this->Cantidad = $Cantidad;

        return $this;
    }

    public function getPrecioUnitario(): ?float
    {
        return $this->precioUnitario;
    }

    public function setPrecioUnitario(float $precioUnitario): static
    {
        $this->precioUnitario = $precioUnitario;

        return $this;
    }
}
