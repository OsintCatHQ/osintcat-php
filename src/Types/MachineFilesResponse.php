<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class MachineFilesResponse extends JsonSerializableType
{
    /**
     * @var ?bool $success
     */
    #[JsonProperty('success')]
    public ?bool $success;

    /**
     * @var ?array<MachineFile> $tree Every file of the machine, with its path.
     */
    #[JsonProperty('tree'), ArrayType([MachineFile::class])]
    public ?array $tree;

    /**
     * @param array{
     *   success?: ?bool,
     *   tree?: ?array<MachineFile>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->success = $values['success'] ?? null;
        $this->tree = $values['tree'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
