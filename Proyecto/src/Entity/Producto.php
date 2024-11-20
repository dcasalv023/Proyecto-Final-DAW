<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(length: 255)]
    private ?string $imagenUrl = null;

    // Relación muchos a uno con Categoria
    #[ORM\ManyToOne(targetEntity: Categoria::class, inversedBy: 'productos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categoria $categoria = null;

    // Relación inversa con Carrito
    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: Carrito::class)]
    private Collection $carritos;

    // Relación muchos a muchos con ListaDeseos
    #[ORM\ManyToMany(targetEntity: ListaDeseos::class, mappedBy: 'productos')]
    private Collection $listasDeseos;

    // Relación muchos a muchos con DetalleOrden
    #[ORM\ManyToMany(targetEntity: DetalleOrden::class, mappedBy: 'productos')]
    private Collection $detallesOrden;

    public function __construct()
    {
        $this->carritos = new ArrayCollection();
        $this->listasDeseos = new ArrayCollection();
        $this->detallesOrden = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;
        return $this;
    }

    public function getImagenUrl(): ?string
    {
        return $this->imagenUrl;
    }

    public function setImagenUrl(string $imagenUrl): static
    {
        $this->imagenUrl = $imagenUrl;
        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;
        return $this;
    }

    public function getCarritos(): Collection
    {
        return $this->carritos;
    }

    public function addCarrito(Carrito $carrito): static
    {
        if (!$this->carritos->contains($carrito)) {
            $this->carritos->add($carrito);
            $carrito->setProducto($this);
        }

        return $this;
    }

    public function removeCarrito(Carrito $carrito): static
    {
        if ($this->carritos->removeElement($carrito)) {
            if ($carrito->getProducto() === $this) {
                $carrito->setProducto(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name; 
    }

}
