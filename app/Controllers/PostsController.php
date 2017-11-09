<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class PostsController extends Controller
{
    /**
     * API call to get all posts
     */
    public function index()
    {
        $http = new Client;
        $host = config('oauth.host');
        $prefix = config('oauth.prefix');
        $accessToken = session('access_token');

        $response = $http->request('GET', $host . $prefix . '/posts', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $posts = json_decode((string) $response->getBody(), true);

        $_SESSION['posts'] = $posts['data'];
        $_SESSION['status'] = 'Posts data received.';

        view('welcome.php');
    }

    /**
     * API call to delete specified post
     *
     * @param array $query [$paramName => $paramValue]
     */
    public function destroy($query)
    {
        $id = $query['id'];

        $http = new Client;
        $host = config('oauth.host');
        $prefix = config('oauth.prefix');
        $accessToken = session('access_token');

        try {
            $response = $http->request('POST', $host . $prefix . "/posts/{$id}/destroy", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            $result = json_decode((string) $response->getBody(), true);

            unset($_SESSION['posts']);
            $_SESSION['status'] = $result['status'];
            return $this->redirect('index');
        } catch (ClientException $e) {
            echo $e->getResponse()->getBody();
        }
    }

    /**
     * Clears posts data
     */
    public function clear()
    {
        unset($_SESSION['posts']);

        $_SESSION['status'] = 'Posts data cleared.';

        view('welcome.php');
    }
}
