<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class ModulesModules extends JsonSerializableType
{
    /**
     * @var ?string $id Module id.
     */
    #[JsonProperty('id')]
    public ?string $id;

    /**
     * @var ?string $name Display name.
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $category Category it is listed under.
     */
    #[JsonProperty('category')]
    public ?string $category;

    /**
     * @var ?bool $enabled Whether the module is switched on.
     */
    #[JsonProperty('enabled')]
    public ?bool $enabled;

    /**
     * @var ?string $accessLevel `public`, `beta`, `staff` or `nobody`.
     */
    #[JsonProperty('access_level')]
    public ?string $accessLevel;

    /**
     * @var ?array<mixed> $allowedPlans Plans the module is limited to (empty: all plans).
     */
    #[JsonProperty('allowed_plans'), ArrayType(['mixed'])]
    public ?array $allowedPlans;

    /**
     * @var ?bool $accessible Whether your account can use it right now.
     */
    #[JsonProperty('accessible')]
    public ?bool $accessible;

    /**
     * @var ?bool $locked Shown, but not usable on your plan.
     */
    #[JsonProperty('locked')]
    public ?bool $locked;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   category?: ?string,
     *   enabled?: ?bool,
     *   accessLevel?: ?string,
     *   allowedPlans?: ?array<mixed>,
     *   accessible?: ?bool,
     *   locked?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->category = $values['category'] ?? null;
        $this->enabled = $values['enabled'] ?? null;
        $this->accessLevel = $values['accessLevel'] ?? null;
        $this->allowedPlans = $values['allowedPlans'] ?? null;
        $this->accessible = $values['accessible'] ?? null;
        $this->locked = $values['locked'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
