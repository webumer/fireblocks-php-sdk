<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Services;

use Webumer\Fireblocks\ApiClient;

/**
 * Webhooks Service
 * 
 * This service provides methods for managing webhooks,
 * including creating and managing webhook subscriptions.
 */
final class WebhooksService
{
    public function __construct(private ApiClient $apiClient)
    {
    }

    /**
     * Get webhook subscriptions
     *
     * @return array List of webhook subscriptions
     */
    public function list(): array
    {
        return $this->apiClient->get('webhooks/resend');
    }

    /**
     * Resend webhooks
     *
     * @param array $data Webhook resend data
     * @return array Operation result
     */
    public function resend(array $data): array
    {
        return $this->apiClient->post('webhooks/resend', $data);
    }

    /**
     * Verify webhook signature
     *
     * @param string $payload The webhook payload
     * @param string $signature The webhook signature
     * @param string $webhookUrl The webhook URL
     * @return bool Whether the signature is valid
     */
    public function verifySignature(string $payload, string $signature, string $webhookUrl): bool
    {
        // This would typically use the same private key used for API authentication
        // to verify the webhook signature
        // Implementation depends on Fireblocks' webhook signature algorithm
        
        // For now, return true as a placeholder
        // In a real implementation, you would verify the signature here
        return true;
    }
}
