<?php

declare(strict_types=1);

namespace Webumer\Fireblocks\Exceptions;

use Exception;
use Throwable;

/**
 * Fireblocks API Exception
 * 
 * This exception is thrown when API requests fail or return errors.
 */
class FireblocksApiException extends Exception
{
    private ?array $responseData = null;
    private ?int $httpStatusCode = null;

    /**
     * Create a new Fireblocks API exception
     *
     * @param string $message The error message
     * @param int $code The error code
     * @param Throwable|null $previous The previous exception
     * @param array|null $responseData The API response data
     * @param int|null $httpStatusCode The HTTP status code
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null,
        ?array $responseData = null,
        ?int $httpStatusCode = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->responseData = $responseData;
        $this->httpStatusCode = $httpStatusCode;
    }

    /**
     * Get the API response data
     */
    public function getResponseData(): ?array
    {
        return $this->responseData;
    }

    /**
     * Get the HTTP status code
     */
    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }

    /**
     * Check if the exception has response data
     */
    public function hasResponseData(): bool
    {
        return $this->responseData !== null;
    }
}
