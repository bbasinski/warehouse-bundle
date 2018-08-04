<?php

namespace Bbasinski\WarehouseBundle\Controller;

use Bbasinski\WarehouseBundle\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ItemsController extends Controller
{
    public function available(ItemRepository $itemRepository)
    {
        return $this->json(
            [
                'items' => $itemRepository->findAllAvailableItems()
            ]
        );
    }

    public function unavailable(ItemRepository $itemRepository)
    {
        return $this->json(
            [
                'items' => $itemRepository->findAllUnavailableItems()
            ]
        );
    }

    public function amountOver(int $amount, ItemRepository $itemRepository)
    {
        return $this->json(
            [
                'items' => $itemRepository->findAllAmountOver($amount)
            ]
        );
    }
}
