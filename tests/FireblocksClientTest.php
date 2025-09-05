<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Tests;

use PHPUnit\Framework\TestCase;
use Webumer\Fireblocks\FireblocksClient;
use Webumer\Fireblocks\Auth\ApiKeyAuthProvider;

class FireblocksClientTest extends TestCase
{
    public function testCanCreateClient(): void
    {
        $authProvider = new ApiKeyAuthProvider('test-api-key', 'test-private-key');
        $client = new FireblocksClient($authProvider);
        
        $this->assertInstanceOf(FireblocksClient::class, $client);
    }

    public function testCanCreateSandboxClient(): void
    {
        $authProvider = new ApiKeyAuthProvider('test-api-key', 'test-private-key');
        $client = FireblocksClient::forSandbox($authProvider);
        
        $this->assertInstanceOf(FireblocksClient::class, $client);
    }

    public function testCanCreateProductionClient(): void
    {
        $authProvider = new ApiKeyAuthProvider('test-api-key', 'test-private-key');
        $client = FireblocksClient::forProduction($authProvider);
        
        $this->assertInstanceOf(FireblocksClient::class, $client);
    }

    public function testHasServiceMethods(): void
    {
        $authProvider = new ApiKeyAuthProvider('test-api-key', 'test-private-key');
        $client = new FireblocksClient($authProvider);
        
        $this->assertNotNull($client->vaults());
        $this->assertNotNull($client->transactions());
        $this->assertNotNull($client->addresses());
        $this->assertNotNull($client->webhooks());
        $this->assertNotNull($client->assets());
    }
}
