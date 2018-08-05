<?php declare(strict_types=1);

namespace Bbasinski\WarehouseBundle\Service;

use Bbasinski\WarehouseBundle\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;

class EditItemService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function edit(int $id, string $name, string $amount): void
    {
        /** @var Item $item */
        $item = $this->entityManager->getRepository(Item::class)->find($id);

        if (!$item) {
            throw new \InvalidArgumentException('Item not found');
        }

        $item->setName($name);
        $item->setAmount($amount);

        $this->entityManager->flush();
    }

}
