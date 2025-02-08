<?php

require __DIR__ . '/../vendor/autoload.php';

use DeepSeek\DeepSeekClient;

$apiKey = 'your-api-key';
$deepSeek = new DeepSeekClient($apiKey);

$messages = [['role' => 'user', 'content' => 'Hello, DeepSeek!']];
$response = $deepSeek->chat('deepseek-model', $messages);

print_r($response);
