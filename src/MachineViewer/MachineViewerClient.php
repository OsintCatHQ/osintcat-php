<?php

namespace OsintCat\MachineViewer;

use Psr\Http\Client\ClientInterface;
use OsintCat\Core\Client\RawClient;
use OsintCat\Types\MachineViewerStats;
use OsintCat\Exceptions\OsintcatException;
use OsintCat\Exceptions\OsintcatApiException;
use OsintCat\Core\Json\JsonApiRequest;
use OsintCat\Environments;
use OsintCat\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use OsintCat\MachineViewer\Requests\SearchMachineViewerRequest;
use OsintCat\Types\MachineSearchResponse;
use OsintCat\Types\MachineInfoResponse;
use OsintCat\Types\MachineFilesResponse;
use OsintCat\Types\MachineFileResponse;

class MachineViewerClient
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
     * How many machines, files, passwords, tokens, cookies and payment cards the Machine Viewer holds.
     *
     * Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?MachineViewerStats
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function stats(?array $options = null): ?MachineViewerStats
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/machine_viewer/stats",
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
                return MachineViewerStats::fromJson($json);
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
     * Searches machines by name, username, hostname or machine ID.
     *
     * Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
     *
     * @param SearchMachineViewerRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?MachineSearchResponse
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function search(SearchMachineViewerRequest $request, ?array $options = null): ?MachineSearchResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['query'] = $request->query;
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/machine_viewer/search",
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
                return MachineSearchResponse::fromJson($json);
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
     * One machine, with the e-mail addresses and tokens found on it.
     *
     * Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
     *
     * @param string $machineId Machine ID (a UUID), from `machineViewer.search`.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?MachineInfoResponse
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function machine(string $machineId, ?array $options = null): ?MachineInfoResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/machine_viewer/machines/{$machineId}/info",
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
                return MachineInfoResponse::fromJson($json);
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
     * Every file of a machine, with its path and size. Use a file's `id` with `machineViewer.file`.
     *
     * Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
     *
     * @param string $machineId Machine ID (a UUID), from `machineViewer.search`.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?MachineFilesResponse
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function files(string $machineId, ?array $options = null): ?MachineFilesResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/machine_viewer/machines/{$machineId}/files/treeview",
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
                return MachineFilesResponse::fromJson($json);
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
     * One file, with its content as text.
     *
     * Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
     *
     * @param string $fileId File ID, from `machineViewer.files`.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?MachineFileResponse
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function file(string $fileId, ?array $options = null): ?MachineFileResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/machine_viewer/files/{$fileId}/info",
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
                return MachineFileResponse::fromJson($json);
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
     * The file itself, as it was in the log.
     *
     * Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
     *
     * @param string $fileId File ID, from `machineViewer.files`.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return string
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function downloadFile(string $fileId, ?array $options = null): string
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/machine_viewer/files/{$fileId}/download",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return $response->getBody()->getContents();
            }
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
     * Every file of a machine in one ZIP archive.
     *
     * Every Machine Viewer request counts as one lookup against your plan's daily allowance (Max: unlimited). When the allowance is used up, requests can continue at a per-lookup price charged to your balance; a search that finds nothing is not charged.
     *
     * Docs: https://docs.osintcat.net/api-reference/endpoint/machine-viewer
     *
     * @param string $machineId Machine ID (a UUID), from `machineViewer.search`.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return string
     * @throws OsintcatException
     * @throws OsintcatApiException
     */
    public function downloadMachine(string $machineId, ?array $options = null): string
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "api/machine_viewer/machines/{$machineId}/download",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return $response->getBody()->getContents();
            }
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
