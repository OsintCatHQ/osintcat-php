<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class ModulesUser extends JsonSerializableType
{
    /**
     * @var ?string $plan Plan id.
     */
    #[JsonProperty('plan')]
    public ?string $plan;

    /**
     * @var ?string $role Account role.
     */
    #[JsonProperty('role')]
    public ?string $role;

    /**
     * @var ?bool $betaAccess Whether the account has beta access.
     */
    #[JsonProperty('beta_access')]
    public ?bool $betaAccess;

    /**
     * @param array{
     *   plan?: ?string,
     *   role?: ?string,
     *   betaAccess?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->plan = $values['plan'] ?? null;
        $this->role = $values['role'] ?? null;
        $this->betaAccess = $values['betaAccess'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
