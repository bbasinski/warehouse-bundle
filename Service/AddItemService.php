<?php declare(strict_types=1);

namespace Bbasinski\WarehouseBundle\Service;

use Bbasinski\WarehouseBundle\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;

class AddItemService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $name
     * @param int $amount
     * @return bool
     */
    public function create(string $name, int $amount): bool
    {
        if (!strlen(trim($name))) {
            throw new \InvalidArgumentException('Name cant be empty');
        }

        $item = new Item();
        $item->setName($name);
        $item->setAmount($amount);

        $this->entityManager->persist($item);
        $this->entityManager->flush();

        return true;
    }
}
