<?php

namespace DeepSeek;

class ResponseHandler
{
    public static function handle(array $response): array
    {
        if (isset($response['error'])) {
            throw new Exceptions\DeepSeekException($response['message'] ?? 'An unknown error occurred.');
        }
        return $response;
    }
}
