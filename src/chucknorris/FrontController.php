<?php

namespace chucknorris;

class FrontController
{
    public function inicio()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $queryString = $_SERVER['QUERY_STRING'];

        // Remove the initial part of the URI (e.g., /chucknorris/)
        $baseUri = '/chucknorris/';
        if (strpos($uri, $baseUri) === 0) {
            $uri = substr($uri, strlen($baseUri));
        }

        // Handle API routes
        switch ($uri) {
            case 'getCategories':
                require 'getCategories.php';
                break;

            case 'getRandomJoke':
                // Pass query parameters to the handler if needed
                $_GET = [];
                parse_str($queryString, $_GET);
                require 'getRandomJoke.php';
                break;

            case 'searchJokes':
                // Pass query parameters to the handler if needed
                $_GET = [];
                parse_str($queryString, $_GET);
                require 'searchJokes.php';
                break;

            default:
                header("HTTP/1.0 404 Not Found");
                echo json_encode(["error" => "Endpoint not found"]);
                break;
        }
        exit();
    }
}
