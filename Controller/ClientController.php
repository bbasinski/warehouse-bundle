<?php

namespace Bbasinski\WarehouseBundle\Controller;

use GuzzleHttp\Client;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

        if (!is_null($endpoint)){
            $results = $this->getResults(self::AVAILABLE_ENDPOINTS[$endpoint], $request);
        }

        ob_start();
        require __DIR__ . '/../Resources/views/endpoints.html.php';

        return new Response(ob_get_clean(), Response::HTTP_NOT_FOUND);
    }

    private function getResults($endpointUri, Request $request)
    {

        $uri = $request->getScheme() . '://' . '127.0.0.1:8001' . $endpointUri;

        var_dump(file_get_contents($uri));
    }
}
