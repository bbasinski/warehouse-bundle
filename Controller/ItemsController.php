<?php declare(strict_types=1);

namespace Bbasinski\WarehouseBundle\Controller;

use Bbasinski\WarehouseBundle\Repository\ItemRepository;
use Bbasinski\WarehouseBundle\Service\AddItemService;
use Bbasinski\WarehouseBundle\Service\DeleteItemService;
use Bbasinski\WarehouseBundle\Service\EditItemService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ItemsController extends Controller
{
    public function add(AddItemService $addItemService, Request $request): JsonResponse
    {
        $data = \GuzzleHttp\json_decode($request->getContent());

        $addItemService->create(
            $data->item->name,
            (int)$data->item->amount
        );

        return $this->successMessage(sprintf('Item %s successfully added.', $data->item->name));
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

    public function getById(int $id, ItemRepository $itemRepository): JsonResponse
    {
        return $this->json(
            [
                'item' => $itemRepository->find($id)
            ]
        );
    }

    public function available(ItemRepository $itemRepository): JsonResponse
    {
        return $this->json(
            [
                'items' => $itemRepository->findAllAvailableItems()
            ]
        );
    }

    public function unavailable(ItemRepository $itemRepository): JsonResponse
    {
        return $this->json(
            [
                'items' => $itemRepository->findAllUnavailableItems()
            ]
        );
    }

    public function amountOver(int $amount, ItemRepository $itemRepository): JsonResponse
    {
        return $this->json(
            [
                'items' => $itemRepository->findAllAmountOver($amount)
            ]
        );
    }

    public function edit(int $id, Request $request, EditItemService $editItemService): JsonResponse
    {
        $data = \GuzzleHttp\json_decode($request->getContent());

        $editItemService->edit(
            $id,
            $data->item->name,
            (int)$data->item->amount
        );

        return $this->successMessage(sprintf('Item %s successfully saved.', $data->item->name));
    }

    public function delete(int $id, DeleteItemService $deleteItemService)
    {
        $deleteItemService->delete($id);

        return $this->successMessage('Item deleted');
    }
}
