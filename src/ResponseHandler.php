<?php

namespace SoliCode;

use GuzzleHttp\Psr7\Response;
use SoliCode\DeepSeekException;

class ResponseHandler
{
    public static function handle(Response $response): array
    {
        $statusCode = $response->getStatusCode();
        $bodyContents = $response->getBody()->getContents();
        $data = json_decode($bodyContents, true);

        // Handle HTTP errors
        if ($statusCode >= 400) {
            $errorMessage = $data['error_msg'] ?? 'Unknown API error';
            throw new DeepSeekException(
                "API Error ($statusCode): $errorMessage",
                $statusCode
            );
        }

        // Handle invalid JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new DeepSeekException(
                "Invalid JSON response from API",
                $statusCode
            );
        }

        return $data;
    }
}