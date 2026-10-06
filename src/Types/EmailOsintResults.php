<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class EmailOsintResults extends JsonSerializableType
{
    /**
     * @var ?array<mixed> $register Services the address is registered with.
     */
    #[JsonProperty('register'), ArrayType(['mixed'])]
    public ?array $register;

    /**
     * @var ?array<mixed> $breach Breaches the address appears in.
     */
    #[JsonProperty('breach'), ArrayType(['mixed'])]
    public ?array $breach;

    /**
     * @var ?array<mixed> $api Further findings from service lookups (profile names, pictures, account details).
     */
    #[JsonProperty('api'), ArrayType(['mixed'])]
    public ?array $api;

    /**
     * @param array{
     *   register?: ?array<mixed>,
     *   breach?: ?array<mixed>,
     *   api?: ?array<mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->register = $values['register'] ?? null;
        $this->breach = $values['breach'] ?? null;
        $this->api = $values['api'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
