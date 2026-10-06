<?php

namespace OsintCat\Account;

use Psr\Http\Client\ClientInterface;
use OsintCat\Core\Client\RawClient;
use OsintCat\Types\UserResponse;
use OsintCat\Exceptions\OsintcatException;
use OsintCat\Exceptions\OsintcatApiException;
use OsintCat\Core\Json\JsonApiRequest;
use OsintCat\Environments;
use OsintCat\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use OsintCat\Types\ModulesResponse;

class AccountClient
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

    /**
     * Returns the account the API key belongs to: plan, plan expiry, and how many lookups are left today.
     *
     * Does not count as a lookup.
     *
     * Needs the `account:read` scope (keys with all scopes have it).
     *
     * Errors:
     * - 401 `API key required`: No `X-API-KEY` header.
     * - 403 `Invalid API key`: The key does not exist or was revoked.
     * - 403 `insufficient_scope`: The key lacks the `account:read` scope.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/user
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UserResponse
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function get(?array $options = null): ?UserResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/user",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return UserResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new OsintcatException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new OsintcatException(message: $e->getMessage(), previous: $e);
        }
        throw new OsintcatApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Lists every module with its current state and whether your account can use it. Use it to check access before calling a lookup: a lookup for a module your plan does not include is refused with `403 ACCESS_DENIED`.
     *
     * Does not count as a lookup.
     *
     * Needs the `osint:read` scope.
     *
     * Errors:
     * - 401 `Unauthorized`: Missing or unknown key.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/modules
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ModulesResponse
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function modules(?array $options = null): ?ModulesResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/modules",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return ModulesResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new OsintcatException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new OsintcatException(message: $e->getMessage(), previous: $e);
        }
        throw new OsintcatApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
