<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class MachineSearchResponse extends JsonSerializableType
{
    /**
     * @var ?bool $success
     */
    #[JsonProperty('success')]
    public ?bool $success;

    /**
     * @var ?string $query
     */
    #[JsonProperty('query')]
    public ?string $query;

    /**
     * @var ?int $total
     */
    #[JsonProperty('total')]
    public ?int $total;

    /**
     * @var ?array<Machine> $machines
     */
    #[JsonProperty('machines'), ArrayType([Machine::class])]
    public ?array $machines;

    /**
     * @param array{
     *   success?: ?bool,
     *   query?: ?string,
     *   total?: ?int,
     *   machines?: ?array<Machine>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->success = $values['success'] ?? null;
        $this->query = $values['query'] ?? null;
        $this->total = $values['total'] ?? null;
        $this->machines = $values['machines'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
