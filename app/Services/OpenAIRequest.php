<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIRequest
{
    protected $client;
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/completions',
            'timeout'  => 2.0,
            'verify' => public_path('api/cacert.pem'),

        ]);

        $this->apiKey = $apiKey;
    }

    public function getResponse($endpoint, $params = [])
    {
        $response = $this->client->request('GET', $endpoint, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'query' => $params,
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
