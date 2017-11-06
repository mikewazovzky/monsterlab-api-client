<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class RequestsController extends Controller
{
    /**
     * Constract end execute API call based
     *
     * @param array $query - request parameters
     */
    public function index($query)
    {
        $http = new Client;
        $accessToken = session('access_token');
        try {
            $response = $http->request($query['method'], $query['host'] . $query['path'], [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'query' => $this->requestParams($query),
            ]);
            $posts = json_decode((string) $response->getBody(), true);
            $_SESSION['status'] = 'Response received. Status: '.$response->getStatusCode().' '.$response->getReasonPhrase();
            echo(json_encode($posts));
        } catch (ClientException $e) {
            echo $e->getResponse()->getBody();
        }
    }

    protected function requestParams($query)
    {
        $params = [];
        foreach ($query['query'] as $item) {
            $params[$item['key']] = $item['value'];
        }
        return $params;
    }
}
