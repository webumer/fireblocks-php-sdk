<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Tests;

use PHPUnit\Framework\TestCase;
use Webumer\Fireblocks\FireblocksClient;
use Webumer\Fireblocks\Auth\ApiKeyAuthProvider;

class FireblocksClientTest extends TestCase
{
    /**
     * @covers \Webumer\Fireblocks\FireblocksClient::__construct
     */
    public function testCanCreateClient(): void
    {
        $authProvider = new ApiKeyAuthProvider('test-api-key', 'test-private-key');
        $client = new FireblocksClient($authProvider);
        
        $this->assertInstanceOf(FireblocksClient::class, $client);
    }

    /**
     * @covers \Webumer\Fireblocks\FireblocksClient::forSandbox
     */
    public function testCanCreateSandboxClient(): void
    {
        $authProvider = new ApiKeyAuthProvider('test-api-key', 'test-private-key');
        $client = FireblocksClient::forSandbox($authProvider);
        
        $this->assertInstanceOf(FireblocksClient::class, $client);
    }

    /**
     * @covers \Webumer\Fireblocks\FireblocksClient::forProduction
     */
    public function testCanCreateProductionClient(): void
    {
        $authProvider = new ApiKeyAuthProvider('test-api-key', 'test-private-key');
        $client = FireblocksClient::forProduction($authProvider);
        
        $this->assertInstanceOf(FireblocksClient::class, $client);
    }

    /**
     * @covers \Webumer\Fireblocks\FireblocksClient::vaults
     * @covers \Webumer\Fireblocks\FireblocksClient::transactions
     * @covers \Webumer\Fireblocks\FireblocksClient::addresses
     * @covers \Webumer\Fireblocks\FireblocksClient::webhooks
     * @covers \Webumer\Fireblocks\FireblocksClient::assets
     */
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
