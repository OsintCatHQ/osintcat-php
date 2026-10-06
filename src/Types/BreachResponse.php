<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class BreachResponse extends JsonSerializableType
{
    /**
     * @var ?string $api Always `OsintCat`.
     */
    #[JsonProperty('api')]
    public ?string $api;

    /**
     * @var ?float $elapsedMs Time the search took, in milliseconds.
     */
    #[JsonProperty('elapsed_ms')]
    public ?float $elapsedMs;

    /**
     * @var ?string $timestamp When the search ran (UTC), e.g. `Oct 6th 09:41`.
     */
    #[JsonProperty('timestamp')]
    public ?string $timestamp;

    /**
     * @var ?float $resultsCount Number of records in `breach_data`.
     */
    #[JsonProperty('results_count')]
    public ?float $resultsCount;

    /**
     * @var ?array<mixed> $breachData Matching records. The fields of a record depend on the breach it comes from (for example `email`, `username`, `password`, `hash`, `ip`, `name`, `phone`); `source_db` names the breach or index the record was found in.
     */
    #[JsonProperty('breach_data'), ArrayType(['mixed'])]
    public ?array $breachData;

    /**
     * @var ?UsageMeta $meta
     */
    #[JsonProperty('_meta')]
    public ?UsageMeta $meta;

    /**
     * @param array{
     *   api?: ?string,
     *   elapsedMs?: ?float,
     *   timestamp?: ?string,
     *   resultsCount?: ?float,
     *   breachData?: ?array<mixed>,
     *   meta?: ?UsageMeta,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->api = $values['api'] ?? null;
        $this->elapsedMs = $values['elapsedMs'] ?? null;
        $this->timestamp = $values['timestamp'] ?? null;
        $this->resultsCount = $values['resultsCount'] ?? null;
        $this->breachData = $values['breachData'] ?? null;
        $this->meta = $values['meta'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
