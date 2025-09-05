<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Services;

use Webumer\Fireblocks\ApiClient;

/**
 * Transactions Service
 * 
 * This service provides methods for managing transactions,
 * including creating, listing, and monitoring transactions.
 */
final class TransactionsService
{
    public function __construct(private ApiClient $apiClient)
    {
    }

    /**
     * Get all transactions
     *
     * @param array $filters Optional filters
     * @return array List of transactions
     */
    public function list(array $filters = []): array
    {
        return $this->apiClient->get('transactions', $filters);
    }

    /**
     * Get a specific transaction by ID
     *
     * @param string $transactionId The transaction ID
     * @return array Transaction details
     */
    public function get(string $transactionId): array
    {
        return $this->apiClient->get("transactions/{$transactionId}");
    }

    /**
     * Create a new transaction
     *
     * @param array $data Transaction data
     * @param array $options Optional request options
     * @return array Created transaction
     */
    public function create(array $data, array $options = []): array
    {
        return $this->apiClient->post('transactions', $data, $options);
    }

    /**
     * Cancel a transaction
     *
     * @param string $transactionId The transaction ID
     * @return array Operation result
     */
    public function cancel(string $transactionId): array
    {
        return $this->apiClient->post("transactions/{$transactionId}/cancel");
    }

    /**
     * Drop a transaction
     *
     * @param string $transactionId The transaction ID
     * @param array $data Drop transaction data
     * @return array Operation result
     */
    public function drop(string $transactionId, array $data): array
    {
        return $this->apiClient->post("transactions/{$transactionId}/drop", $data);
    }

    /**
     * Freeze a transaction
     *
     * @param string $transactionId The transaction ID
     * @return array Operation result
     */
    public function freeze(string $transactionId): array
    {
        return $this->apiClient->post("transactions/{$transactionId}/freeze");
    }

    /**
     * Unfreeze a transaction
     *
     * @param string $transactionId The transaction ID
     * @return array Operation result
     */
    public function unfreeze(string $transactionId): array
    {
        return $this->apiClient->post("transactions/{$transactionId}/unfreeze");
    }
}
