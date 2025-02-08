<?php

use PHPUnit\Framework\TestCase;
use DeepSeek\DeepSeekClient;

class DeepSeekTest extends TestCase
{
    public function testChatResponseFormat()
    {
        $client = new DeepSeekClient('test-api-key', 'https://mock.deepseek.com');
        $response = $client->chat('test-model', [['role' => 'user', 'content' => 'Test message']]);

        $this->assertIsArray($response);
    }
}
