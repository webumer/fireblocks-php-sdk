# Fireblocks PHP SDK Examples

This directory contains examples demonstrating how to use the Fireblocks PHP SDK.

## Basic Usage

```php
<?php

require_once 'vendor/autoload.php';

use Webumer\Fireblocks\FireblocksClient;
use Webumer\Fireblocks\Auth\ApiKeyAuthProvider;

// Initialize the client with your credentials
$authProvider = new ApiKeyAuthProvider(
    apiKey: 'your-api-key-here',
    privateKey: 'your-private-key-here'
);

// Create client for sandbox environment
$client = FireblocksClient::forSandbox($authProvider);

// Get all vault accounts
echo "Fetching vault accounts...\n";
$vaults = $client->vaults()->list();
echo "Found " . count($vaults) . " vault accounts\n";

// Get supported assets
echo "Fetching supported assets...\n";
$assets = $client->assets()->list();
echo "Found " . count($assets) . " supported assets\n";

// Get recent transactions
echo "Fetching recent transactions...\n";
$transactions = $client->transactions()->list(['limit' => 10]);
echo "Found " . count($transactions) . " recent transactions\n";
```

## Creating a Transaction

```php
<?php

use Webumer\Fireblocks\FireblocksClient;
use Webumer\Fireblocks\Auth\ApiKeyAuthProvider;

$authProvider = new ApiKeyAuthProvider($apiKey, $privateKey);
$client = FireblocksClient::forSandbox($authProvider);

// Create a transaction
$transaction = $client->transactions()->create([
    'assetId' => 'ETH',
    'source' => ['type' => 'VAULT_ACCOUNT', 'id' => '0'],
    'destination' => ['type' => 'EXTERNAL_WALLET', 'id' => 'external-wallet-id'],
    'amount' => '0.1',
    'note' => 'Test transaction from PHP SDK'
]);

echo "Transaction created: " . $transaction['id'] . "\n";
```

## Generating Addresses

```php
<?php

use Webumer\Fireblocks\FireblocksClient;
use Webumer\Fireblocks\Auth\ApiKeyAuthProvider;

$authProvider = new ApiKeyAuthProvider($apiKey, $privateKey);
$client = FireblocksClient::forSandbox($authProvider);

// Generate a new address
$address = $client->addresses()->generate(
    vaultAccountId: '0',
    assetId: 'ETH',
    options: ['description' => 'My ETH address']
);

echo "Generated address: " . $address['address'] . "\n";
```

## Error Handling

```php
<?php

use Webumer\Fireblocks\FireblocksClient;
use Webumer\Fireblocks\Auth\ApiKeyAuthProvider;
use Webumer\Fireblocks\Exceptions\FireblocksApiException;

try {
    $authProvider = new ApiKeyAuthProvider($apiKey, $privateKey);
    $client = FireblocksClient::forSandbox($authProvider);
    
    $vaults = $client->vaults()->list();
    
} catch (FireblocksApiException $e) {
    echo "API Error: " . $e->getMessage() . "\n";
    echo "HTTP Status: " . $e->getHttpStatusCode() . "\n";
    
    if ($e->hasResponseData()) {
        echo "Response Data: " . json_encode($e->getResponseData()) . "\n";
    }
} catch (Exception $e) {
    echo "General Error: " . $e->getMessage() . "\n";
}
```
