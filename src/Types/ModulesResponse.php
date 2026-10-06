<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class ModulesResponse extends JsonSerializableType
{
    /**
     * @var ?array<ModulesModules> $modules One entry per module.
     */
    #[JsonProperty('modules'), ArrayType([ModulesModules::class])]
    public ?array $modules;

    /**
     * @var ?ModulesUser $user
     */
    #[JsonProperty('user')]
    public ?ModulesUser $user;

    /**
     * @param array{
     *   modules?: ?array<ModulesModules>,
     *   user?: ?ModulesUser,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->modules = $values['modules'] ?? null;
        $this->user = $values['user'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
