<?php

namespace OsintCat\Ip;

use Psr\Http\Client\ClientInterface;
use OsintCat\Core\Client\RawClient;
use OsintCat\Ip\Requests\LookupIpRequest;
use OsintCat\Types\IpResponse;
use OsintCat\Exceptions\OsintcatException;
use OsintCat\Exceptions\OsintcatApiException;
use OsintCat\Core\Json\JsonApiRequest;
use OsintCat\Environments;
use OsintCat\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class IpClient
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
     * Returns what is known about an IP address: open ports and services seen on it, hostnames, and its location and network.
     *
     * Results for the same address may come from a cache for up to two days.
     *
     * Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/ip
     *
     * @param LookupIpRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?IpResponse
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function lookup(LookupIpRequest $request, ?array $options = null): ?IpResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['query'] = $request->query;
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/ip",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return IpResponse::fromJson($json);
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
