<?php

namespace App\Entity;

use App\Repository\ListaDeseosRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ListaDeseosRepository::class)]
class ListaDeseos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Relación muchos a uno con Usuario
    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'listasDeseos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    // Relación muchos a muchos con Producto
    #[ORM\ManyToMany(targetEntity: Producto::class, inversedBy: 'listasDeseos')]
    private Collection $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
