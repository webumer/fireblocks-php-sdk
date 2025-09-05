<?php

declare(strict_types=1);

namespace Webumer\Fireblocks;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Webumer\Fireblocks\Auth\IAuthProvider;
use Webumer\Fireblocks\Exceptions\FireblocksApiException;

/**
 * HTTP API client for Fireblocks
 * 
 * This class handles all HTTP communication with the Fireblocks API,
 * including authentication, request/response handling, and error management.
 */
final class ApiClient
{
    private Client $httpClient;
    private string $userAgent;

    /**
     * Create a new API client instance
     *
     * @param IAuthProvider $authProvider Authentication provider
     * @param string $baseUrl Base URL for the Fireblocks API
     * @param array $options Additional configuration options
     */
    public function __construct(
        private IAuthProvider $authProvider,
        private string $baseUrl,
        private array $options = []
    ) {
        $this->userAgent = $this->buildUserAgent();
        
        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->options['timeout'] ?? 30,
            'headers' => [
                'X-API-Key' => $this->authProvider->getApiKey(),
                'User-Agent' => $this->userAgent,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * Make a GET request
     *
     * @param string $path The API path
     * @param array $queryParams Query parameters
     * @param array $requestOptions Additional request options
     * @return array The response data
     * @throws FireblocksApiException
     */
    public function get(string $path, array $queryParams = [], array $requestOptions = []): array
    {
        $path = $this->normalizePath($path);
        
        if (!empty($queryParams)) {
            $path .= '?' . http_build_query($queryParams);
        }

        $token = $this->authProvider->signJwt($path);
        
        try {
            $response = $this->httpClient->get($path, [
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new FireblocksApiException('GET request failed: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Make a POST request
     *
     * @param string $path The API path
     * @param mixed $body Request body
     * @param array $requestOptions Additional request options
     * @return array The response data
     * @throws FireblocksApiException
     */
    public function post(string $path, mixed $body = null, array $requestOptions = []): array
    {
        $path = $this->normalizePath($path);
        $token = $this->authProvider->signJwt($path, $body);
        
        $headers = ['Authorization' => "Bearer {$token}"];
        
        if (isset($requestOptions['idempotencyKey'])) {
            $headers['Idempotency-Key'] = $requestOptions['idempotencyKey'];
        }

        try {
            $response = $this->httpClient->post($path, [
                'headers' => $headers,
                'json' => $body
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new FireblocksApiException('POST request failed: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Make a PUT request
     *
     * @param string $path The API path
     * @param mixed $body Request body
     * @param array $requestOptions Additional request options
     * @return array The response data
     * @throws FireblocksApiException
     */
    public function put(string $path, mixed $body = null, array $requestOptions = []): array
    {
        $path = $this->normalizePath($path);
        $token = $this->authProvider->signJwt($path, $body);
        
        try {
            $response = $this->httpClient->put($path, [
                'headers' => ['Authorization' => "Bearer {$token}"],
                'json' => $body
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new FireblocksApiException('PUT request failed: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Make a PATCH request
     *
     * @param string $path The API path
     * @param mixed $body Request body
     * @param array $requestOptions Additional request options
     * @return array The response data
     * @throws FireblocksApiException
     */
    public function patch(string $path, mixed $body = null, array $requestOptions = []): array
    {
        $path = $this->normalizePath($path);
        $token = $this->authProvider->signJwt($path, $body);
        
        try {
            $response = $this->httpClient->patch($path, [
                'headers' => ['Authorization' => "Bearer {$token}"],
                'json' => $body
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new FireblocksApiException('PATCH request failed: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Make a DELETE request
     *
     * @param string $path The API path
     * @param array $requestOptions Additional request options
     * @return array The response data
     * @throws FireblocksApiException
     */
    public function delete(string $path, array $requestOptions = []): array
    {
        $path = $this->normalizePath($path);
        $token = $this->authProvider->signJwt($path);
        
        try {
            $response = $this->httpClient->delete($path, [
                'headers' => ['Authorization' => "Bearer {$token}"]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new FireblocksApiException('DELETE request failed: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Normalize the API path
     */
    private function normalizePath(string $path): string
    {
        // Remove leading slash if present
        $path = ltrim($path, '/');
        
        // Ensure path starts with v1/
        if (!str_starts_with($path, 'v1/')) {
            $path = 'v1/' . $path;
        }
        
        return $path;
    }

    /**
     * Build the User-Agent string
     */
    private function buildUserAgent(): string
    {
        $sdkVersion = '1.0.0'; // This should match composer.json version
        $userAgent = "fireblocks-sdk-php/{$sdkVersion}";
        
        if (!($this->options['anonymousPlatform'] ?? false)) {
            $userAgent .= ' (' . PHP_OS . '; ' . PHP_VERSION . ')';
        }
        
        if (isset($this->options['userAgent'])) {
            $userAgent = $this->options['userAgent'] . ' ' . $userAgent;
        }
        
        return $userAgent;
    }
}
