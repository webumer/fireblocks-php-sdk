<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * API Key authentication provider
 * 
 * This provider uses an API key and private key to authenticate
 * with the Fireblocks API using JWT tokens.
 */
final class ApiKeyAuthProvider implements IAuthProvider
{
    private string $apiKey;
    private string $privateKey;

    /**
     * Create a new API key authentication provider
     *
     * @param string $apiKey The Fireblocks API key
     * @param string $privateKey The private key for JWT signing
     */
    public function __construct(string $apiKey, string $privateKey)
    {
        $this->apiKey = $apiKey;
        $this->privateKey = $privateKey;
    }

    /**
     * Get the API key
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Sign a JWT token for the given path and optional body
     *
     * @param string $path The API path
     * @param mixed $body Optional request body
     * @return string The signed JWT token
     */
    public function signJwt(string $path, mixed $body = null): string
    {
        $now = time();
        
        // Ensure the path starts with / for proper JWT signing
        $uri = '/' . ltrim($path, '/');
        
        $payload = [
            'uri' => $uri,
            'nonce' => $now,
            'iat' => $now,
            'exp' => $now + 30, // 30 seconds expiration
            'sub' => $this->apiKey,
            'bodyHash' => $body ? hash('sha256', (string) json_encode($body)) : ''
        ];

        return JWT::encode($payload, $this->privateKey, 'RS256');
    }
}