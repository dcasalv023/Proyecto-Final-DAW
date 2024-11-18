<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null; // Cambiado a 'nombre'

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null; // Cambiado a 'descripcion'

    // Relación uno a muchos con Producto
    #[ORM\OneToMany(mappedBy: 'categoria', targetEntity: Producto::class)]
    private Collection $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string // Cambiado a 'getNombre'
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static // Cambiado a 'setNombre'
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string // Cambiado a 'getDescripcion'
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static // Cambiado a 'setDescripcion'
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Producto>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): static
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setCategoria($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): static
    {
        if ($this->productos->removeElement($producto)) {
            if ($producto->getCategoria() === $this) {
                $producto->setCategoria(null);
            }
        }

        return $this;
    }
}
