<?php

namespace DeepSeek;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class DeepSeekClient
{
    private string $apiKey;
    private Client $httpClient;
    private string $baseUrl;

    public function __construct(string $apiKey, string $baseUrl = 'https://api.deepseek.com')
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl,
            'headers'  => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ]
        ]);
    }

    public function request(string $endpoint, array $payload = []): array
    {
        try {
            $response = $this->httpClient->post($endpoint, ['json' => $payload]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

    public function chat(string $model, array $messages): array
    {
        return $this->request('/v1/chat', [
            'model' => $model,
            'messages' => $messages
        ]);
    }
}
