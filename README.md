# 🚀 SoliCode DeepSeek PHP Client  

A **powerful**, **well-structured**, and **fully featured** PHP client for the **DeepSeek AI API**, developed by **SoliCode**. This library provides seamless integration with DeepSeek's AI models, offering robust functionality for **chat interactions, model exploration, and image generation**.  

---

## ✨ Features  

✅ **Modern PHP (PSR-4 Autoloading, Composer-ready)**  
✅ **Effortless API requests with Guzzle**  
✅ **Robust error handling & exceptions**  
✅ **Supports Chat API & Model listing**  
✅ **AI-powered Image Generation API**  
✅ **Production-ready with CI/CD via GitHub Actions**  
✅ **Comprehensive Unit Testing (PHPUnit)**  
✅ **Easy-to-use, highly extensible**  

---

## 📦 Installation  

Ensure you have **Composer** installed, then run:  

```sh
composer require solicode/deepseek-php-client
```  

---

## 🚀 Quick Start  

```php
<?php

require 'vendor/autoload.php';

use SoliCode\DeepSeekClient;

$apiKey = 'your-api-key'; // Replace with your actual DeepSeek API key
$client = new DeepSeekClient($apiKey);

// 🔹 Fetch available AI models
$models = $client->models();
print_r($models);

// 🔹 Chat with DeepSeek AI
$response = $client->chat('deepseek-model', [['role' => 'user', 'content' => 'Hello, AI!']]);
print_r($response);

// 🔹 Generate an AI-powered image
$image = $client->generateImage('A stunning cyberpunk city at night');
print_r($image);

?>
```

---

## 🛠 Running Tests  

Ensure all dependencies are installed, then run:  

```sh
vendor/bin/phpunit tests
```

---

## 📜 License  

This project is licensed under the **MIT License**.  
Developed with ❤️ by [SoliCode](https://solicode.co.uk).  
