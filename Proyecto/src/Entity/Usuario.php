<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $Phone = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Registratio_Date = null;

    #[ORM\Column(length: 255)]
    private ?string $rol = null;

    // Relación uno a muchos con Orden
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Orden::class)]
    private Collection $ordenes;

    // Relación uno a muchos con ListaDeseos
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: ListaDeseos::class)]
    private Collection $listasDeseos;

    // Relación uno a muchos con Carrito
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Carrito::class)]
    private Collection $carritos;

    public function __construct()
    {
        $this->ordenes = new ArrayCollection();
        $this->listasDeseos = new ArrayCollection();
        $this->carritos = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): static
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getRegistratioDate(): ?\DateTimeInterface
    {
        return $this->Registratio_Date;
    }

    public function setRegistratioDate(\DateTimeInterface $Registratio_Date): static
    {
        $this->Registratio_Date = $Registratio_Date;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(string $rol): static
    {
        $this->rol = $rol;

        return $this;
    }
}
