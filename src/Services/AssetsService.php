<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Services;

use Webumer\Fireblocks\ApiClient;

/**
 * Assets Service
 * 
 * This service provides methods for managing assets,
 * including getting supported assets and asset information.
 */
final class AssetsService
{
    public function __construct(private ApiClient $apiClient)
    {
    }

    /**
     * Get all supported assets
     *
     * @return array List of supported assets
     */
    public function list(): array
    {
        return $this->apiClient->get('supported_assets');
    }

    /**
     * Get asset information
     *
     * @param string $assetId The asset ID
     * @return array Asset information
     */
    public function get(string $assetId): array
    {
        return $this->apiClient->get("supported_assets/{$assetId}");
    }

    /**
     * Get asset types
     *
     * @return array List of asset types
     */
    public function getTypes(): array
    {
        return $this->apiClient->get('asset_types');
    }

    /**
     * Get network connections
     *
     * @return array List of network connections
     */
    public function getNetworkConnections(): array
    {
        return $this->apiClient->get('network_connections');
    }

    /**
     * Get network connection by ID
     *
     * @param string $connectionId The connection ID
     * @return array Network connection details
     */
    public function getNetworkConnection(string $connectionId): array
    {
        return $this->apiClient->get("network_connections/{$connectionId}");
    }
}
