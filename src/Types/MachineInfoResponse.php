<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class MachineInfoResponse extends JsonSerializableType
{
    /**
     * @var ?bool $success
     */
    #[JsonProperty('success')]
    public ?bool $success;

    /**
     * @var ?Machine $machine
     */
    #[JsonProperty('machine')]
    public ?Machine $machine;

    /**
     * @var ?array<string> $emails E-mail addresses found on the machine.
     */
    #[JsonProperty('emails'), ArrayType(['string'])]
    public ?array $emails;

    /**
     * @var ?array<string> $tokens Tokens found on the machine.
     */
    #[JsonProperty('tokens'), ArrayType(['string'])]
    public ?array $tokens;

    /**
     * @param array{
     *   success?: ?bool,
     *   machine?: ?Machine,
     *   emails?: ?array<string>,
     *   tokens?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->success = $values['success'] ?? null;
        $this->machine = $values['machine'] ?? null;
        $this->emails = $values['emails'] ?? null;
        $this->tokens = $values['tokens'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
