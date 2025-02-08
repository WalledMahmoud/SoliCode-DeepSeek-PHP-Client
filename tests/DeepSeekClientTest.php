<?php

use PHPUnit\Framework\TestCase;
use SoliCode\DeepSeekClient;
use SoliCode\Exceptions\DeepSeekException;

class DeepSeekClientTest extends TestCase
{
    public function testChatResponseFormat()
    {
        $client = new DeepSeekClient('test-api-key', 'https://mock.deepseek.com');
        $this->expectException(DeepSeekException::class);
        
        $client->chat('test-model', [['role' => 'user', 'content' => 'Test message']]);
    }

    public function testGenerateImage()
    {
        $client = new DeepSeekClient('test-api-key', 'https://mock.deepseek.com');
        $this->expectException(DeepSeekException::class);

        $client->generateImage('A futuristic city skyline at sunset');
    }
}
