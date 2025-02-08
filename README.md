# 🚀 SoliCode DeepSeek PHP Client

[![Latest Version](https://img.shields.io/packagist/v/solicode/deepseek-php-client.svg)](https://packagist.org/packages/solicode/deepseek-php-client)  

A modern PHP client for DeepSeek's AI API, featuring robust error handling and full PSR compliance.

---

## 📦 Installation

Requires **PHP 7.4+** and [Composer](https://getcomposer.org):

```bash
composer require solicode/deepseek-php-client
```

### 🔑 Authentication
Get your API key from DeepSeek Dashboard.

Never commit secrets - store in environment variables.

## 🚀 Basic Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use SoliCode\DeepSeekClient;

try {
    // Initialize client
    $client = new DeepSeekClient('your-api-key');

    // List available models
    $models = $client->models();
    echo "Available models:\n";
    print_r($models['data']);

    // Generate chat completion
    $response = $client->chat(
        model: 'deepseek-chat',
        messages: [
            ['role' => 'user', 'content' => 'Explain quantum entanglement simply']
        ]
    );

    echo "\nResponse:\n" . $response['choices'][0]['message']['content'];

} catch (InsufficientBalanceException $e) {
    die("Error: Add funds to your DeepSeek account");
} catch (\Exception $e) {
    die("Error: {$e->getMessage()}");
}
```

## 📖 Advanced Features

### Custom Request Configuration
```php
$client = new DeepSeekClient(
    apiKey: 'your-key',
    baseUrl: 'https://api.deepseek.com/v1', // Custom endpoint
    timeout: 15, // Seconds
    headers: ['X-Custom-Header' => 'value']
);
```

### Streaming Responses
```php
$stream = $client->chat(
    'deepseek-chat',
    [['role' => 'user', 'content' => 'Explain recursion']],
    ['stream' => true]
);

foreach ($stream as $chunk) {
    echo $chunk['choices'][0]['delta']['content'] ?? '';
}
```

### Error Handling Hierarchy
```php
try {
    // API operations
} catch (InsufficientBalanceException $e) {
    // Handle payment issues (402 errors)
} catch (InvalidRequestException $e) {
    // Handle bad parameters (400 errors)
} catch (AuthenticationException $e) {
    // Handle invalid API keys (401 errors)
} catch (APIConnectionException $e) {
    // Handle network issues
} catch (\Exception $e) {
    // Generic fallback
}
```

## 🛠 Development

### Running Tests
```bash
composer test
```

### Code Quality Checks
```bash
composer check-style
composer fix-style
```

### Contributing
1. Fork the repository.
2. Create a feature branch (`feat/your-feature`).
3. Write tests for new features.
4. Submit a pull request.

## 📚 API Reference

### DeepSeekClient Methods

| Method      | Parameters                                      | Description                  |
|------------|--------------------------------|------------------------------|
| models()   | -                                              | List available models       |
| chat()     | string $model, array $messages, array $params | Generate chat completion    |
| __construct() | string $apiKey, ?string $baseUrl, ?array $options | Client initialization |

## ⚠️ Common Errors

| Error Code | Solution |
|------------|----------|
| 401 Unauthorized | Verify API key validity |
| 402 Payment Required | Add funds to your account |
| 404 Not Found | Verify endpoint URL correctness |
| 429 Rate Limited | Implement request retry logic |

## 📜 License
MIT License - See [LICENSE](LICENSE) for full text.

Developed with ❤️ by **SoliCode** • Report issues [here](https://github.com/WalledMahmoud/SoliCode-DeepSeek-PHP-Client/issues)

