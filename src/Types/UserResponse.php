<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class UserResponse extends JsonSerializableType
{
    /**
     * @var ?UserAccountInfo $accountInfo
     */
    #[JsonProperty('account_info')]
    public ?UserAccountInfo $accountInfo;

    /**
     * @var ?UserUsage $usage
     */
    #[JsonProperty('usage')]
    public ?UserUsage $usage;

    /**
     * @param array{
     *   accountInfo?: ?UserAccountInfo,
     *   usage?: ?UserUsage,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accountInfo = $values['accountInfo'] ?? null;
        $this->usage = $values['usage'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
