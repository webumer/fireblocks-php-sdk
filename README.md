# Fireblocks PHP SDK

[![Packagist Version](https://img.shields.io/packagist/v/webumer/fireblocks-php-sdk.svg)](https://packagist.org/packages/webumer/fireblocks-php-sdk)
[![PHP Version](https://img.shields.io/packagist/php-v/webumer/fireblocks-php-sdk.svg)](https://packagist.org/packages/webumer/fireblocks-php-sdk)
[![License](https://img.shields.io/packagist/l/webumer/fireblocks-php-sdk.svg)](https://packagist.org/packages/webumer/fireblocks-php-sdk)

**Unofficial PHP SDK for Fireblocks API** - A secure digital asset custody and transfer platform.

> ⚠️ **Disclaimer**: This is an unofficial SDK created by the community. It is not affiliated with or endorsed by Fireblocks.

## Installation

```bash
composer require webumer/fireblocks-php-sdk
```

## Quick Start

```php
<?php

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
$vaults = $client->vaults()->list();

// Create a transaction
$transaction = $client->transactions()->create([
    'assetId' => 'ETH',
    'source' => ['type' => 'VAULT_ACCOUNT', 'id' => '0'],
    'destination' => ['type' => 'EXTERNAL_WALLET', 'id' => 'external-wallet-id'],
    'amount' => '0.1',
    'note' => 'Test transaction from PHP SDK'
]);
```

## Features

- ✅ **Vault Management**: Create and manage vault accounts
- ✅ **Transaction Processing**: Send and receive digital assets
- ✅ **Address Generation**: Generate deposit addresses
- ✅ **Webhook Support**: Handle real-time notifications
- ✅ **Multi-Asset Support**: Support for 100+ digital assets
- ✅ **Security**: JWT-based authentication with private key signing
- ✅ **Sandbox Support**: Test with Fireblocks sandbox environment

## API Coverage

This SDK provides comprehensive coverage of the Fireblocks API including:

- **Vaults API**: Account management and operations
- **Transactions API**: Transaction creation and monitoring
- **Addresses API**: Address generation and validation
- **Webhooks API**: Real-time event notifications
- **Assets API**: Supported assets and configurations

## Requirements

- PHP 8.1 or higher
- Guzzle HTTP Client
- Firebase JWT library

## Documentation

For complete API documentation, visit the [Fireblocks API Reference](https://developers.fireblocks.com/reference/api-overview).

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

MIT License - see [LICENSE](LICENSE) file for details.

## Disclaimer

This is an **unofficial** SDK created by the community. It is not affiliated with or endorsed by Fireblocks. Use at your own risk.
