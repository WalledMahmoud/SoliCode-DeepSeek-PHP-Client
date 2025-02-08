<?php

namespace SoliCode;

use SoliCode\Exceptions\DeepSeekException;

class ResponseHandler
{
    public static function handle(array $response): array
    {
        if (isset($response['error'])) {
            throw new DeepSeekException($response['message'] ?? 'An unknown error occurred.');
        }
        return $response;
    }
}
