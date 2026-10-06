<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\Union;

/**
 * Your usage after this request.
 */
class UsageMeta extends JsonSerializableType
{
    /**
     * @var ?string $plan Plan id.
     */
    #[JsonProperty('plan')]
    public ?string $plan;

    /**
     * @var (
     *    float
     *   |string
     * )|null $lookupsLeft Lookups left today, `unlimited` on Max, or `charging` when the allowance is used up and the lookup was charged to your balance.
     */
    #[JsonProperty('lookups_left'), Union('float', 'string', 'null')]
    public float|string|null $lookupsLeft;

    /**
     * @param array{
     *   plan?: ?string,
     *   lookupsLeft?: (
     *    float
     *   |string
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->plan = $values['plan'] ?? null;
        $this->lookupsLeft = $values['lookupsLeft'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
