<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class UserAccountInfo extends JsonSerializableType
{
    /**
     * @var ?string $username Username.
     */
    #[JsonProperty('username')]
    public ?string $username;

    /**
     * @var ?string $email E-mail address of the account.
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var ?string $plan Current plan, e.g. `Researcher`, `Investigator`, `Max`.
     */
    #[JsonProperty('plan')]
    public ?string $plan;

    /**
     * @var ?string $planExpires When the plan ends (ISO 8601), `Lifetime`, or `N/A`.
     */
    #[JsonProperty('plan_expires')]
    public ?string $planExpires;

    /**
     * @param array{
     *   username?: ?string,
     *   email?: ?string,
     *   plan?: ?string,
     *   planExpires?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->username = $values['username'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->plan = $values['plan'] ?? null;
        $this->planExpires = $values['planExpires'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
