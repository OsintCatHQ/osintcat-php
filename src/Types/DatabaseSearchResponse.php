<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class DatabaseSearchResponse extends JsonSerializableType
{
    /**
     * @var ?array<mixed> $results Matching entries (typically a URL, login and password, and when it was collected).
     */
    #[JsonProperty('results'), ArrayType(['mixed'])]
    public ?array $results;

    /**
     * @var ?float $resultsCount Number of entries.
     */
    #[JsonProperty('results_count')]
    public ?float $resultsCount;

    /**
     * @var ?string $query The query searched for.
     */
    #[JsonProperty('query')]
    public ?string $query;

    /**
     * @var ?string $queryType `email` or `domain`.
     */
    #[JsonProperty('type')]
    public ?string $queryType;

    /**
     * @var ?string $executionTime Time the search took.
     */
    #[JsonProperty('execution_time')]
    public ?string $executionTime;

    /**
     * @var ?string $status `success`.
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @param array{
     *   results?: ?array<mixed>,
     *   resultsCount?: ?float,
     *   query?: ?string,
     *   queryType?: ?string,
     *   executionTime?: ?string,
     *   status?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->results = $values['results'] ?? null;
        $this->resultsCount = $values['resultsCount'] ?? null;
        $this->query = $values['query'] ?? null;
        $this->queryType = $values['queryType'] ?? null;
        $this->executionTime = $values['executionTime'] ?? null;
        $this->status = $values['status'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
