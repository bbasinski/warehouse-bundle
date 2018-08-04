<?php

namespace Bbasinski\WarehouseBundle\Controller;

use Bbasinski\WarehouseBundle\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemsController extends Controller
{
    public function available(ItemRepository $itemRepository)
    {
        return new JsonResponse(
            [
                'items' => $itemRepository->findAllAvailableItems()
            ]
        );
    }

    public function unavailable(ItemRepository $itemRepository)
    {
        return new JsonResponse(
            [
                'items' => $itemRepository->findAllUnavailableItems()
            ]
        );
    }

    public function amountOver(int $amount, ItemRepository $itemRepository)
    {
        return new JsonResponse(
            [
                'items' => $itemRepository->findAllAmountOver($amount)
            ]
        );
    }
}
