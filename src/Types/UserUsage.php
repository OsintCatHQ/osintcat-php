<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class UserUsage extends JsonSerializableType
{
    /**
     * @var ?float $requestLimitDaily Lookups per day on this plan (Max: unlimited, shown as a very large number).
     */
    #[JsonProperty('request_limit_daily')]
    public ?float $requestLimitDaily;

    /**
     * @var ?float $requestsRemainingToday Lookups left today. Resets at 00:00 UTC.
     */
    #[JsonProperty('requests_remaining_today')]
    public ?float $requestsRemainingToday;

    /**
     * @var ?bool $apiAccess Whether the plan includes API access.
     */
    #[JsonProperty('api_access')]
    public ?bool $apiAccess;

    /**
     * @param array{
     *   requestLimitDaily?: ?float,
     *   requestsRemainingToday?: ?float,
     *   apiAccess?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->requestLimitDaily = $values['requestLimitDaily'] ?? null;
        $this->requestsRemainingToday = $values['requestsRemainingToday'] ?? null;
        $this->apiAccess = $values['apiAccess'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
