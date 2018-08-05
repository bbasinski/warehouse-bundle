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
        $results = new \stdClass();
        $results->items = [];

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
        $uri = $this->getApiUri($request);

        $client = new Client();

        return \GuzzleHttp\json_decode($client->get($uri . $endpointUri)->getBody());
    }

    /**
     * @param Request $request
     * @return array|false|string
     */
    private function getApiUri(Request $request)
    {
        $uri = $request->getSchemeAndHttpHost();

        $envUri = getenv('API_URI');

        if ($envUri) {
            $uri = $envUri;
        }

        return $uri;
    }

    public function add(Request $request)
    {
        $message = false;

        if ($request->getMethod() === Request::METHOD_POST) {
            $client = new Client();
            $addResponse = \GuzzleHttp\json_decode(
                $client->post($this->getApiUri($request) . "/items",
                    [
                        'json' => [
                            "item" => [
                                "name" => $request->get('name'),
                                "amount" => $request->get('amount')
                            ]
                        ],
                    ]
                )->getBody()->getContents()
            );

            if ($addResponse->status === 'success') {
                $message = $addResponse->message;
            }
        }

        return $this->render(
            '@BbasinskiWarehouseBundle/Resources/views/client/add.html.php',
            [
                'message' => $message
            ]
        );
    }

    public function edit(int $itemId, Request $request)
    {
        $message = false;
        $item = null;
        $client = new Client();
        $api = $this->getApiUri($request);

        if ($request->getMethod() === Request::METHOD_POST) {
            $editResponse = \GuzzleHttp\json_decode(
                $client->post($api . "/items/{$itemId}",
                    [
                        'json' => [
                            "item" => [
                                "name" => $request->get('name'),
                                "amount" => $request->get('amount')
                            ]
                        ],
                    ]
                )->getBody()->getContents()
            );

            if ($editResponse->status === 'success') {
                $message = $editResponse->message;
            }
        }

        $itemResponse = \GuzzleHttp\json_decode($client->get($api . "/items/{$itemId}")->getBody());

        if (!empty($itemResponse->item)) {
            $item = $itemResponse->item;
        } else {
            return $this->redirect('/');
        }

        return $this->render(
            '@BbasinskiWarehouseBundle/Resources/views/client/edit.html.php',
            [
                'message' => $message,
                'item' => $item
            ]
        );
    }
}
