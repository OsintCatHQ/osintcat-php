<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class PhoneOsintRisk extends JsonSerializableType
{
    /**
     * @var ?float $score Score from 0 to 100, or `null`.
     */
    #[JsonProperty('score')]
    public ?float $score;

    /**
     * @var ?string $level `low`, `medium`, `high` or `unknown`.
     */
    #[JsonProperty('level')]
    public ?string $level;

    /**
     * @param array{
     *   score?: ?float,
     *   level?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->score = $values['score'] ?? null;
        $this->level = $values['level'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
