<?php

namespace OsintCat\Phone;

use Psr\Http\Client\ClientInterface;
use OsintCat\Core\Client\RawClient;
use OsintCat\Phone\Requests\LookupPhoneRequest;
use OsintCat\Types\PhoneOsintResponse;
use OsintCat\Exceptions\OsintcatException;
use OsintCat\Exceptions\OsintcatApiException;
use OsintCat\Core\Json\JsonApiRequest;
use OsintCat\Environments;
use OsintCat\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class PhoneClient
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
     * Returns what is known about a phone number: whether it is valid, the carrier and line type, the country, linked online accounts and a risk score.
     *
     * Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.
     *
     * Errors:
     * - 400 `phone_*`: The number cannot be a valid phone number; `code` says why (e.g. `phone_too_short`).
     * - 424 `Upstream provider error`: The lookup could not be completed.
     * - 424 `The request timed out.`: The lookup took too long.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/phone-osint
     *
     * @param LookupPhoneRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?PhoneOsintResponse
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function lookup(LookupPhoneRequest $request, ?array $options = null): ?PhoneOsintResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['query'] = $request->query;
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/phone-osint",
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
                return PhoneOsintResponse::fromJson($json);
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
