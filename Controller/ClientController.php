<?php

namespace Bbasinski\WarehouseBundle\Controller;

use Bbasinski\WarehouseBundle\Service\AddItemService;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    const AVAILABLE_ENDPOINTS = [
        'available' => '/items/available',
        'unavailable' => '/items/unavailable',
        'amount-over-5' => '/items/amount/over/5',
    ];

    public function endpoints(Request $request)
    {
        $endpoint = $request->get('endpoint');
        $results = [];

        if (!is_null($endpoint) && !isset(self::AVAILABLE_ENDPOINTS[$endpoint])) {
            return $this->redirect('/');
        }

        if (!is_null($endpoint)) {
            $results = $this->getResults(self::AVAILABLE_ENDPOINTS[$endpoint], $request);
        }

        return $this->render(
            '@BbasinskiWarehouseBundle/Resources/views/client/endpoints.html.php',
            [
                'results' => $results,
                'endpoint' => $endpoint
            ]
        );
    }

    private function getResults($endpointUri, Request $request)
    {
        $uri = $request->getSchemeAndHttpHost();

        $envUri = getenv('API_URI');

        if ($envUri) {
            $uri = $envUri;
        }

        $client = new Client();

        return \GuzzleHttp\json_decode($client->get($uri . $endpointUri)->getBody());
    }

    public function add(Request $request, AddItemService $addItemService)
    {
        $message = false;

        if ($request->getMethod() === Request::METHOD_POST) {
            $message = $addItemService->create(
                $request->get('name'),
                $request->get('amount')
            );
        }

        return $this->render(
            '@BbasinskiWarehouseBundle/Resources/views/client/add.html.php',
            [
                'message' => $message
            ]
        );
    }
}
