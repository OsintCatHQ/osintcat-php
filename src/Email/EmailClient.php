<?php

namespace OsintCat\Email;

use Psr\Http\Client\ClientInterface;
use OsintCat\Core\Client\RawClient;
use OsintCat\Email\Requests\LookupEmailRequest;
use OsintCat\Types\EmailOsintResponse;
use OsintCat\Exceptions\OsintcatException;
use OsintCat\Exceptions\OsintcatApiException;
use OsintCat\Core\Json\JsonApiRequest;
use OsintCat\Environments;
use OsintCat\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class EmailClient
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
     * Checks which websites and services an e-mail address is registered with and in which breaches it appears. Every request must state its purpose.
     *
     * A request without a purpose (parameter `purpose`, header `X-Purpose`, or `Purpose: ...` at the end of your User-Agent) is refused with `400 USER_AGENT_IDENTITY_REQUIRED`.
     *
     * Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.
     *
     * Errors:
     * - 400 `USER_AGENT_IDENTITY_REQUIRED`: No purpose given.
     * - 401 `API key required`: No `X-API-KEY` header.
     * - 402 `INSUFFICIENT_BALANCE`: The allowance is used up and your balance does not cover the lookup.
     * - 424 `Provider Error`: The lookup could not be completed. Not charged.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/email-osint
     *
     * @param LookupEmailRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?EmailOsintResponse
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function lookup(LookupEmailRequest $request, ?array $options = null): ?EmailOsintResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['query'] = $request->query;
        $query['purpose'] = $request->purpose;
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/email-osint",
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
                return EmailOsintResponse::fromJson($json);
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
