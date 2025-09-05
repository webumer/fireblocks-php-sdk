<?php

declare(strict_types=1);

namespace Webumer\Fireblocks;

use Webumer\Fireblocks\Auth\IAuthProvider;
use Webumer\Fireblocks\Services\VaultsService;
use Webumer\Fireblocks\Services\TransactionsService;
use Webumer\Fireblocks\Services\AddressesService;
use Webumer\Fireblocks\Services\WebhooksService;
use Webumer\Fireblocks\Services\AssetsService;

/**
 * Main Fireblocks SDK Client
 * 
 * This is the primary class for interacting with the Fireblocks API.
 * It provides access to all service modules and handles authentication.
 */
final class FireblocksClient
{
    private ApiClient $apiClient;
    private VaultsService $vaults;
    private TransactionsService $transactions;
    private AddressesService $addresses;
    private WebhooksService $webhooks;
    private AssetsService $assets;

    /**
     * Create a new Fireblocks client instance
     *
     * @param IAuthProvider $authProvider Authentication provider
     * @param string $baseUrl Base URL for the Fireblocks API
     * @param array $options Additional configuration options
     */
    public function __construct(
        private IAuthProvider $authProvider,
        private string $baseUrl = 'https://api.fireblocks.io',
        private array $options = []
    ) {
        $this->apiClient = new ApiClient($authProvider, $baseUrl, $options);
        
        // Initialize service modules
        $this->vaults = new VaultsService($this->apiClient);
        $this->transactions = new TransactionsService($this->apiClient);
        $this->addresses = new AddressesService($this->apiClient);
        $this->webhooks = new WebhooksService($this->apiClient);
        $this->assets = new AssetsService($this->apiClient);
    }

    /**
     * Get the Vaults service
     */
    public function vaults(): VaultsService
    {
        return $this->vaults;
    }

    /**
     * Get the Transactions service
     */
    public function transactions(): TransactionsService
    {
        return $this->transactions;
    }

    /**
     * Get the Addresses service
     */
    public function addresses(): AddressesService
    {
        return $this->addresses;
    }

    /**
     * Get the Webhooks service
     */
    public function webhooks(): WebhooksService
    {
        return $this->webhooks;
    }

    /**
     * Get the Assets service
     */
    public function assets(): AssetsService
    {
        return $this->assets;
    }

    /**
     * Get the underlying API client
     */
    public function getApiClient(): ApiClient
    {
        return $this->apiClient;
    }

    /**
     * Create a client for sandbox environment
     */
    public static function forSandbox(IAuthProvider $authProvider, array $options = []): self
    {
        return new self($authProvider, 'https://sandbox-api.fireblocks.io', $options);
    }

    /**
     * Create a client for production environment
     */
    public static function forProduction(IAuthProvider $authProvider, array $options = []): self
    {
        return new self($authProvider, 'https://api.fireblocks.io', $options);
    }

    /**
     * Get the authentication provider
     */
    public function getAuthProvider(): IAuthProvider
    {
        return $this->authProvider;
    }

    /**
     * Get the base URL
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Get the configuration options
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}