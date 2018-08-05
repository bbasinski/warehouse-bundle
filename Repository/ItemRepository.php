<?php declare(strict_types=1);

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

    /**
     * @return Item[]
     */
    public function findAllUnavailableItems(): array
    {
        $builder = $this->createQueryBuilder('i')
            ->andWhere('i.amount <= 0')
            ->getQuery();

        return $builder->execute();
    }

    /**
     * @param int $amount
     * @return Item[]
     */
    public function findAllAmountOver(int $amount): array
    {
        $builder = $this->createQueryBuilder('i')
            ->andWhere('i.amount > :amount')
            ->setParameter('amount', $amount)
            ->getQuery();

        return $builder->execute();
    }
}
