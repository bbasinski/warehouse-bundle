<?php

namespace Bbasinski\WarehouseBundle\Repository;

use Bbasinski\WarehouseBundle\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Item::class);
    }

    /**
     * @return Item[]
     */
    public function findAllAvailableItems(): array
    {
        $builder = $this->createQueryBuilder('i')
            ->andWhere('i.amount > 0')
            ->getQuery();

        return $builder->execute();
    }
}
