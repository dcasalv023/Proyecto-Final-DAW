<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'json')]
    private array $roles = ['ROLE_USER']; 

    #[ORM\Column]
    private bool $isVerified = false;

    // Relación uno a muchos con Carrito
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Carrito::class, cascade: ['persist', 'remove'])]
    private Collection $carritos;

    // Relación uno a muchos con ListaDeseos
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: ListaDeseos::class, cascade: ['persist', 'remove'])]
    private Collection $listasDeseos;

    // Relación uno a muchos con Orden
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Orden::class, cascade: ['persist', 'remove'])]
    private Collection $ordenes;

    public function __construct()
    {
        $this->carritos = new ArrayCollection();
        $this->listasDeseos = new ArrayCollection();
        $this->ordenes = new ArrayCollection();

        // Garantizar que siempre el usuario tenga el rol de 'ROLE_USER'
        if (!in_array('ROLE_USER', $this->roles)) {
            $this->roles[] = 'ROLE_USER';
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return array_unique($this->roles);
    }

    public function setRoles(array $roles): self
    {
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }
        $this->roles = array_unique($roles);

        return $this;
    }

    public function eraseCredentials(): void
    {
        // Método para borrar credenciales sensibles si es necesario
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    // Métodos para Carrito
    public function getCarritos(): Collection
    {
        return $this->carritos;
    }

    public function addCarrito(Carrito $carrito): static
    {
        if (!$this->carritos->contains($carrito)) {
            $this->carritos->add($carrito);
            $carrito->setUsuario($this);  
        }

        return $this;
    }

    public function removeCarrito(Carrito $carrito): static
    {
        if ($this->carritos->removeElement($carrito)) {
            if ($carrito->getUsuario() === $this) {
                $carrito->setUsuario(null);  
            }
        }

        return $this;
    }

    // Métodos para ListaDeseos
    public function getListasDeseos(): Collection
    {
        return $this->listasDeseos;
    }

    public function addListaDeseos(ListaDeseos $listaDeseos): static
    {
        if (!$this->listasDeseos->contains($listaDeseos)) {
            $this->listasDeseos->add($listaDeseos);
            $listaDeseos->setUsuario($this);  
        }

        return $this;
    }

    public function removeListaDeseos(ListaDeseos $listaDeseos): static
    {
        if ($this->listasDeseos->removeElement($listaDeseos)) {
            if ($listaDeseos->getUsuario() === $this) {
                $listaDeseos->setUsuario(null);  
            }
        }

        return $this;
    }


    public function getOrdenes(): Collection
    {
        return $this->ordenes;
    }

    public function addOrden(Orden $orden): static
    {
        if (!$this->ordenes->contains($orden)) {
            $this->ordenes->add($orden);
            $orden->setUsuario($this); 
        }

        return $this;
    }

    public function removeOrden(Orden $orden): static
    {
        if ($this->ordenes->removeElement($orden)) {
            if ($orden->getUsuario() === $this) {
                $orden->setUsuario(null);  
            }
        }

        return $this;
    }
}
