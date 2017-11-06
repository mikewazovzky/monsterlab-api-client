<?php

return [
    'GET' => [
        '/home'          => ['controller' => 'PagesController', 'action' => 'welcome'],
        '/clear'         => ['controller' => 'PagesController', 'action' => 'clear'],
        '/login'         => ['controller' => 'OauthController', 'action' => 'login'],
        '/logout'        => ['controller' => 'OauthController', 'action' => 'logout'],
        '/callback'      => ['controller' => 'OauthController', 'action' => 'callback'],
        '/user'          => ['controller' => 'UsersController', 'action' => 'show'],
        '/user/clear'    => ['controller' => 'UsersController', 'action' => 'clear'],
        '/posts'         => ['controller' => 'PostsController', 'action' => 'index'],
        '/posts/clear'   => ['controller' => 'PostsController', 'action' => 'clear'],
        '/posts/destroy' => ['controller' => 'PostsController', 'action' => 'destroy'],
    ],

    'POST' => [
        '/request' => ['controller' => 'RequestsController', 'action' => 'index'],
    ]
];
