<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Services;

use Webumer\Fireblocks\ApiClient;

/**
 * Addresses Service
 * 
 * This service provides methods for managing addresses,
 * including generating and validating addresses.
 */
final class AddressesService
{
    public function __construct(private ApiClient $apiClient)
    {
    }

    /**
     * Generate a new address
     *
     * @param string $vaultAccountId The vault account ID
     * @param string $assetId The asset ID
     * @param array $options Optional generation options
     * @return array Generated address details
     */
    public function generate(string $vaultAccountId, string $assetId, array $options = []): array
    {
        $data = array_merge([
            'vaultAccountId' => $vaultAccountId,
            'assetId' => $assetId
        ], $options);

        return $this->apiClient->post('vault/accounts/generate_address', $data);
    }

    /**
     * Get addresses for a vault account
     *
     * @param string $vaultAccountId The vault account ID
     * @param string $assetId The asset ID
     * @param array $filters Optional filters
     * @return array List of addresses
     */
    public function list(string $vaultAccountId, string $assetId, array $filters = []): array
    {
        $path = "vault/accounts/{$vaultAccountId}/{$assetId}/addresses";
        return $this->apiClient->get($path, $filters);
    }

    /**
     * Validate an address
     *
     * @param string $assetId The asset ID
     * @param string $address The address to validate
     * @return array Validation result
     */
    public function validate(string $assetId, string $address): array
    {
        $data = [
            'assetId' => $assetId,
            'address' => $address
        ];

        return $this->apiClient->post('transactions/validate_address', $data);
    }

    /**
     * Get public key information
     *
     * @param string $vaultAccountId The vault account ID
     * @param string $assetId The asset ID
     * @param int $change The change index
     * @param int $addressIndex The address index
     * @return array Public key information
     */
    public function getPublicKeyInfo(string $vaultAccountId, string $assetId, int $change, int $addressIndex): array
    {
        $data = [
            'vaultAccountId' => $vaultAccountId,
            'assetId' => $assetId,
            'change' => $change,
            'addressIndex' => $addressIndex
        ];

        return $this->apiClient->post('vault/accounts/public_key_info', $data);
    }
}
