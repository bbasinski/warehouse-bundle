<?php

namespace Bbasinski\WarehouseBundle\Controller;

use Bbasinski\WarehouseBundle\Entity\Item;
use Bbasinski\WarehouseBundle\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemsController extends Controller
{
    public function available()
    {
        /** @var ItemRepository $itemsRepository */
        $itemsRepository = $this->getDoctrine()->getRepository(Item::class);

        return new JsonResponse($itemsRepository->findAllAvailableItems());
    }

}
