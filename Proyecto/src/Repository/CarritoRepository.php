<?php
// src/Repository/CarritoRepository.php
namespace App\Repository;

use App\Entity\Carrito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Carrito>
 */
class CarritoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carrito::class);
    }

    public function findByUsuario($usuarioId): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.usuario = :usuarioId')
            ->setParameter('usuarioId', $usuarioId)
            ->getQuery()
            ->getResult();
    }

    public function vaciarCarrito($usuarioId): void
    {
        $this->createQueryBuilder('c')
            ->delete()
            ->where('c.usuario = :usuarioId')
            ->setParameter('usuarioId', $usuarioId)
            ->getQuery()
            ->execute();
    }
}


