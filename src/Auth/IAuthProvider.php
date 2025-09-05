<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Auth;

/**
 * Authentication provider interface
 * 
 * Implementations of this interface handle authentication
 * with the Fireblocks API using JWT tokens.
 */
interface IAuthProvider
{
    /**
     * Get the API key
     */
    public function getApiKey(): string;

    /**
     * Sign a JWT token for the given path and optional body
     *
     * @param string $path The API path
     * @param mixed $body Optional request body
     * @return string The signed JWT token
     */
    public function signJwt(string $path, mixed $body = null): string;
}