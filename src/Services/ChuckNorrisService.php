<?php

namespace Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Utils\EnvVariableReader;

class ChuckNorrisService
{
    protected $client;
    protected $apiHost;
    protected $apiKey;

    public function __construct()
    {
        // Load environment variables
        $this->apiHost = EnvVariableReader::getEnvVariable('RAPIDAPI_HOST');
        $this->apiKey = EnvVariableReader::getEnvVariable('RAPIDAPI_KEY');

        $this->client = new Client([
            'base_uri' => 'https://' . $this->apiHost,
            'headers' => [
                'X-RapidAPI-Host' => $this->apiHost,
                'X-RapidAPI-Key' => $this->apiKey,
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function getRandomJoke($category = null)
    {
        try {
            $response = $this->client->get('/jokes/random', [
                'query' => ['category' => $category]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function getCategories()
    {
        try {
            $response = $this->client->get('/jokes/categories');

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function searchJokes($query)
    {
        try {
            $response = $this->client->get('/jokes/search', [
                'query' => ['query' => $query]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    private function handleException(RequestException $e)
    {
        if ($e->hasResponse()) {
            $error = $e->getResponse()->getBody()->getContents();
            return 'Error: ' . $error;
        } else {
            return 'Request failed: ' . $e->getMessage();
        }
    }
}
