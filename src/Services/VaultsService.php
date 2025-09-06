<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Services;

use Webumer\Fireblocks\ApiClient;

/**
 * Vaults Service
 * 
 * This service provides methods for managing vault accounts,
 * including creating, listing, and updating vault accounts.
 */
final class VaultsService
{
    public function __construct(private ApiClient $apiClient)
    {
    }

    /**
     * Get all vault accounts
     *
     * @param array $filters Optional filters
     * @return array List of vault accounts
     */
    public function list(array $filters = []): array
    {
        return $this->apiClient->get('vault/accounts', $filters);
    }

    /**
     * Get a specific vault account by ID
     *
     * @param string $vaultAccountId The vault account ID
     * @return array Vault account details
     */
    public function get(string $vaultAccountId): array
    {
        return $this->apiClient->get("vault/accounts/{$vaultAccountId}");
    }

    /**
     * Create a new vault account
     *
     * @param array $data Vault account data
     * @return array Created vault account
     */
    public function create(array $data): array
    {
        return $this->apiClient->post('vault/accounts', $data);
    }

    /**
     * Update a vault account
     *
     * @param string $vaultAccountId The vault account ID
     * @param array $data Updated vault account data
     * @return array Updated vault account
     */
    public function update(string $vaultAccountId, array $data): array
    {
        return $this->apiClient->put("vault/accounts/{$vaultAccountId}", $data);
    }

    /**
     * Hide a vault account
     *
     * @param string $vaultAccountId The vault account ID
     * @return array Operation result
     */
    public function hide(string $vaultAccountId): array
    {
        return $this->apiClient->post("vault/accounts/{$vaultAccountId}/hide");
    }

    /**
     * Unhide a vault account
     *
     * @param string $vaultAccountId The vault account ID
     * @return array Operation result
     */
    public function unhide(string $vaultAccountId): array
    {
        return $this->apiClient->post("vault/accounts/{$vaultAccountId}/unhide");
    }

    /**
     * Create a vault wallet for a specific asset
     *
     * @param string $vaultAccountId The vault account ID
     * @param string $assetId The asset ID
     * @return array Created vault wallet
     */
    public function createVaultWallet(string $vaultAccountId, string $assetId): array
    {
        return $this->apiClient->post("vault/accounts/{$vaultAccountId}/{$assetId}");
    }

    /**
     * Create a deposit address for a vault wallet
     *
     * @param string $vaultAccountId The vault account ID
     * @param string $assetId The asset ID
     * @param array $options Optional address creation options
     * @return array Created address details
     */
    public function createDepositAddress(string $vaultAccountId, string $assetId, array $options = []): array
    {
        return $this->apiClient->post("vault/accounts/{$vaultAccountId}/{$assetId}/addresses", $options);
    }

    /**
     * Get vault account assets
     *
     * @param string $vaultAccountId The vault account ID
     * @param array $filters Optional filters
     * @return array List of assets
     */
    public function getAssets(string $vaultAccountId, array $filters = []): array
    {
        return $this->apiClient->get("vault/accounts/{$vaultAccountId}", $filters);
    }

    /**
     * Get vault account asset by ID
     *
     * @param string $vaultAccountId The vault account ID
     * @param string $assetId The asset ID
     * @return array Asset details
     */
    public function getAsset(string $vaultAccountId, string $assetId): array
    {
        return $this->apiClient->get("vault/accounts/{$vaultAccountId}/{$assetId}");
    }
}
