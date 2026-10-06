<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

/**
 * Results for the same address may come from a cache for up to 15 minutes.
 */
class EmailOsintResponse extends JsonSerializableType
{
    /**
     * @var ?EmailOsintResults $results
     */
    #[JsonProperty('results')]
    public ?EmailOsintResults $results;

    /**
     * @param array{
     *   results?: ?EmailOsintResults,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->results = $values['results'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
