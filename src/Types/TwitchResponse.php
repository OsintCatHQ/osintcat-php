<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

/**
 * `taken` is `true` when the account exists. `ExtraData` holds what the profile shows publicly; a field the profile does not have is left out. When the lookup could not be completed, `taken` is `false` and `error` says why (for example `rate_limited`, try again later).
 */
class TwitchResponse extends JsonSerializableType
{
    /**
     * @var ?bool $taken Whether an account with this username exists.
     */
    #[JsonProperty('taken')]
    public ?bool $taken;

    /**
     * @var ?string $error Present only when the lookup could not be completed.
     */
    #[JsonProperty('error')]
    public ?string $error;

    /**
     * @var ?TwitchExtraData $extraData
     */
    #[JsonProperty('ExtraData')]
    public ?TwitchExtraData $extraData;

    /**
     * @param array{
     *   taken?: ?bool,
     *   error?: ?string,
     *   extraData?: ?TwitchExtraData,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->taken = $values['taken'] ?? null;
        $this->error = $values['error'] ?? null;
        $this->extraData = $values['extraData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
