<?php

use App\Request;
use App\Router;

require __DIR__.'/autoload.php';
session_start();

$request = new Request();
$router = new Router();

$router->loadRoutes(include(__DIR__ . '/routes.php'));
$router->loadFallbackRoute('PagesController', 'welcome');
$router->process($request);
