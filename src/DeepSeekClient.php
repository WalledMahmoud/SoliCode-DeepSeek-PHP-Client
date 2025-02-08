<?php

namespace SoliCode;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use SoliCode\ResponseHandler;

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

    private function request(string $method, string $endpoint, array $payload = []): array
    {
        try {
            $options = !empty($payload) ? ['json' => $payload] : [];
            $response = $this->httpClient->request($method, $endpoint, $options);
            return ResponseHandler::handle(json_decode($response->getBody()->getContents(), true));
        } catch (RequestException $e) {
            throw new DeepSeekException($e->getMessage());
        }
    }

    public function chat(string $model, array $messages): array
    {
        return $this->request('POST', '/v1/chat', [
            'model' => $model,
            'messages' => $messages
        ]);
    }

    public function models(): array
    {
        return $this->request('GET', '/v1/models');
    }

    public function generateImage(string $prompt): array
    {
        return $this->request('POST', '/v1/images', ['prompt' => $prompt]);
    }
}
