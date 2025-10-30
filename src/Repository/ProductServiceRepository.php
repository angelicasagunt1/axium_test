<?php

namespace App\Repository;

use App\Entity\ProductService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductService>
 */
class ProductServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductService::class);
    }

    public function existsByCode(string $code): bool
    {
        return $this->createQueryBuilder('p')
                ->select('1')
                ->where('p.code = :code')
                ->setParameter('code', $code)
                ->getQuery()
                ->getOneOrNullResult() !== null;
    }
}
