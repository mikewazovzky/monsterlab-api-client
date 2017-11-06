<?php

namespace App\Controllers;

use GuzzleHttp\Client;

class UsersController extends Controller
{
    /**
     * Get currently authenticated user
     */
    public function show()
    {
        $http = new Client;
        $host = config('oauth.host');
        $prefix = config('oauth.prefix');
        $accessToken = session('access_token');

        $response = $http->request('GET', $host . $prefix . '/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $user = json_decode((string) $response->getBody(), true);

        $_SESSION['user'] = $user;
        $_SESSION['status'] = 'User data received.';

        view('welcome.php');
    }

    /**
     * Clear user data
     */
    public function clear()
    {
        unset($_SESSION['user']);

        $_SESSION['status'] = 'User data cleared.';

        view('welcome.php');
    }
}
