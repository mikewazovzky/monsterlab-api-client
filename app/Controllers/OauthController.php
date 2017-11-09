<?php

namespace App\Controllers;

use App\View;
use GuzzleHttp\Client;

class OauthController extends Controller
{
    protected $filename = __DIR__ . '/../../storage/tdata.txt';

    /**
     * Redirect to app authorization (oauth) route.
     */
    public function login()
    {
        if ($token = $this->getSavedToken()) {
            $this->setSessionData($token, 'Authorized. [Using saved token.]');
            return view('welcome.php');
        }

        $host = config('oauth.host');
        $client_id = config('oauth.client_id');
        $request_uri = config('oauth.request_uri');
        $query = http_build_query([
            'client_id' => $client_id,
            'redirect_uri' => $request_uri,
            'response_type' => 'code',
            'scope' => '',
        ]);

        redirect($host . '/oauth/authorize?' . $query);
    }

    /**
     * Remove auth data from session
     */
    public function logout()
    {
        unset($_SESSION['access_token']);
        $_SESSION['status'] = 'Login data removed.';
        return view('welcome.php');
    }

    /**
     * Exchange auth code to access token
     *
     * @param type name
     * @return type
     */
    public function callback()
    {
        $code = $_GET['code'];
        $http = new Client;

        $host = config('oauth.host');
        $client_id = config('oauth.client_id');
        $client_secret = config('oauth.client_secret');
        $request_uri = config('oauth.request_uri');

        $response = $http->post($host . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri' => $request_uri,
                'code' => $code,
            ],
        ]);

        $data = json_decode((string) $response->getBody(), true);

        $this->setSessionData($data['access_token']);
        $this->saveToken($data['access_token']);

        view('welcome.php');
    }

    public function destroy()
    {
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }

        unset($_SESSION['access_token']);
        $_SESSION['status'] = 'Login token removed.';
        return view('welcome.php');
    }

    protected function setSessionData($token, $message = 'Authorized.')
    {
        $_SESSION['client_id'] = config('oauth.client_id');
        $_SESSION['client_secret'] = config('oauth.client_secret');
        $_SESSION['access_token'] = $token;
        $_SESSION['status'] = $message;
    }

    protected function getSavedToken()
    {
        if (file_exists($this->filename)) {
            return file_get_contents($this->filename);
        }

        return false;
    }

    protected function saveToken($token)
    {
        file_put_contents($this->filename, $token);
    }
}
