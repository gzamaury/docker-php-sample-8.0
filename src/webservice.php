<?php

$loader = require_once realpath(__DIR__ . '/vendor/autoload.php');
$loader->addPsr4('Utils\\', 'Utils');
$loader->addPsr4('Services\\', 'Services');
$loader->addPsr4('chucknorris\\', 'chucknorris');

use chucknorris\FrontController;

// Get the requested URI and query string
$uri = $_SERVER['REQUEST_URI'];
$queryString = $_SERVER['QUERY_STRING'];

// Serve chucknorris.html directly if accessing webservice.php without any endpoint
if ($uri === '/webservice.php') {
    include 'chucknorris/chucknorris.html';
    exit();
}

// Adjust URI to remove query string for routing
$parsedUrl = parse_url($uri);
$path = $parsedUrl['path'];

// Route requests to the FrontController
$_SERVER['REQUEST_URI'] = $path;
$_SERVER['QUERY_STRING'] = $queryString;

// Handle API requests
$controller = new FrontController();
$controller->inicio();
