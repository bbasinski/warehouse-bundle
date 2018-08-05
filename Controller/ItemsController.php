<?php

namespace Bbasinski\WarehouseBundle\Controller;

use Bbasinski\WarehouseBundle\Repository\ItemRepository;
use Bbasinski\WarehouseBundle\Service\AddItemService;
use Bbasinski\WarehouseBundle\Service\EditItemService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ItemsController extends Controller
{
    public function add(AddItemService $addItemService, Request $request)
    {
        $data = \GuzzleHttp\json_decode($request->getContent());

        $addItemService->create(
            $data->item->name,
            $data->item->amount
        );

        return $this->successMessage(sprintf('Item %s successfully added.', $data->item->name));
    }

    public function getById(string $id, ItemRepository $itemRepository)
    {
        return $this->json(
            [
                'item' => $itemRepository->find($id)
            ]
        );
    }

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

    public function edit(string $id, Request $request, EditItemService $editItemService)
    {
        $data = \GuzzleHttp\json_decode($request->getContent());

        $editItemService->edit(
            $id,
            $data->item->name,
            $data->item->amount
        );

        return $this->successMessage(sprintf('Item %s successfully saved.', $data->item->name));
    }

    private function successMessage(string $message): JsonResponse
    {
        return $this->json(
            [
                'status' => 'success',
                'message' => $message
            ]
        );
    }

    //todo edit, remove, delete
}
