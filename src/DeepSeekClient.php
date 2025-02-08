<?php

namespace SoliCode;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use SoliCode\ResponseHandler;
use SoliCode\DeepSeekException;

class DeepSeekClient
{
    private string $apiKey;
    private Client $httpClient;
    private string $baseUrl;

    public function __construct(string $apiKey, string $baseUrl = 'https://api.deepseek.com/v1')
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl,
            'headers'  => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ],
            'timeout'  => 30  // Added timeout
        ]);
    }

    private function request(string $method, string $endpoint, array $payload = []): array
    {
        try {
            $options = !empty($payload) ? ['json' => $payload] : [];
            $response = $this->httpClient->request($method, $endpoint, $options);
            
            return ResponseHandler::handle($response);  // Pass response object instead of decoded array
            
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $errorBody = json_decode($response?->getBody()?->getContents() ?? '', true);
            
            throw new DeepSeekException(
                $errorBody['error_msg'] ?? $e->getMessage(),
                $response ? $response->getStatusCode() : 500,
                $e
            );
        }
    }

    public function chat(string $model, array $messages, array $params = []): array
    {
        return $this->request('POST', '/chat/completions', array_merge([
            'model' => $model,
            'messages' => $messages,
            'temperature' => 0.7,
            'max_tokens' => 1000
        ], $params));
    }

    public function models(): array
    {
        return $this->request('GET', '/models');
    }

    // Removed generateImage() as DeepSeek doesn't support image generation
}