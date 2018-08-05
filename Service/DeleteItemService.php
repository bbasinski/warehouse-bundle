<?php declare(strict_types=1);

namespace Bbasinski\WarehouseBundle\Service;

use Bbasinski\WarehouseBundle\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;

class DeleteItemService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function delete(int $id): void
    {
        $item = $this->entityManager->getRepository(Item::class)->find($id);
        $this->entityManager->remove($item);
        $this->entityManager->flush();
    }
}
