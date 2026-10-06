<?php

namespace OsintCat\Vin;

use Psr\Http\Client\ClientInterface;
use OsintCat\Core\Client\RawClient;
use OsintCat\Vin\Requests\QueryVinRequest;
use OsintCat\Exceptions\OsintcatException;
use OsintCat\Exceptions\OsintcatApiException;
use OsintCat\Core\Json\JsonApiRequest;
use OsintCat\Environments;
use OsintCat\Core\Client\HttpMethod;
use OsintCat\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class VinClient
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
     * Decodes vehicle identification numbers and answers catalogue questions (makes, models, manufacturers, vehicle variables). Choose what to do with `type`.
     *
     * Counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, the lookup can continue at a per-lookup price charged to your balance (the module's page in the dashboard shows the price); a lookup that finds nothing is not charged.
     *
     * Errors:
     * - 400 `query parameter is required`: `query` missing where the chosen type needs it.
     * - 400 `Maximum 50 VINs allowed`: `batch` with more than 50 VINs.
     * - 400 `Invalid query type / Invalid search_type`: Unknown `type` or `search_type`.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/vin
     *
     * @param QueryVinRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return mixed
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function query(QueryVinRequest $request = new QueryVinRequest(), ?array $options = null): mixed
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->operation != null) {
            $query['type'] = $request->operation;
        }
        if ($request->query != null) {
            $query['query'] = $request->query;
        }
        if ($request->modelYear != null) {
            $query['model_year'] = $request->modelYear;
        }
        if ($request->extended != null) {
            $query['extended'] = $request->extended;
        }
        if ($request->searchType != null) {
            $query['search_type'] = $request->searchType;
        }
        if ($request->year != null) {
            $query['year'] = $request->year;
        }
        if ($request->vehicleType != null) {
            $query['vehicle_type'] = $request->vehicleType;
        }
        if ($request->mfrType != null) {
            $query['mfr_type'] = $request->mfrType;
        }
        if ($request->page != null) {
            $query['page'] = $request->page;
        }
        if ($request->partsType != null) {
            $query['parts_type'] = $request->partsType;
        }
        if ($request->fromDate != null) {
            $query['from_date'] = $request->fromDate;
        }
        if ($request->toDate != null) {
            $query['to_date'] = $request->toDate;
        }
        if ($request->make != null) {
            $query['make'] = $request->make;
        }
        if ($request->model != null) {
            $query['model'] = $request->model;
        }
        if ($request->units != null) {
            $query['units'] = $request->units;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/vin",
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
                return JsonDecoder::decodeMixed($json);
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
