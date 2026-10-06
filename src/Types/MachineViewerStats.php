<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class MachineViewerStats extends JsonSerializableType
{
    /**
     * @var ?int $totalMachines Machines.
     */
    #[JsonProperty('total_machines')]
    public ?int $totalMachines;

    /**
     * @var ?int $totalFiles Files.
     */
    #[JsonProperty('total_files')]
    public ?int $totalFiles;

    /**
     * @var ?int $totalPasswords Passwords.
     */
    #[JsonProperty('total_passwords')]
    public ?int $totalPasswords;

    /**
     * @var ?int $totalUniquePasswords Distinct passwords.
     */
    #[JsonProperty('total_unique_passwords')]
    public ?int $totalUniquePasswords;

    /**
     * @var ?int $totalTokens Tokens.
     */
    #[JsonProperty('total_tokens')]
    public ?int $totalTokens;

    /**
     * @var ?int $totalCookies Cookies.
     */
    #[JsonProperty('total_cookies')]
    public ?int $totalCookies;

    /**
     * @var ?int $totalCreditCards Payment cards.
     */
    #[JsonProperty('total_credit_cards')]
    public ?int $totalCreditCards;

    /**
     * @var ?int $totalSize Size of all files, in bytes.
     */
    #[JsonProperty('total_size')]
    public ?int $totalSize;

    /**
     * @param array{
     *   totalMachines?: ?int,
     *   totalFiles?: ?int,
     *   totalPasswords?: ?int,
     *   totalUniquePasswords?: ?int,
     *   totalTokens?: ?int,
     *   totalCookies?: ?int,
     *   totalCreditCards?: ?int,
     *   totalSize?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->totalMachines = $values['totalMachines'] ?? null;
        $this->totalFiles = $values['totalFiles'] ?? null;
        $this->totalPasswords = $values['totalPasswords'] ?? null;
        $this->totalUniquePasswords = $values['totalUniquePasswords'] ?? null;
        $this->totalTokens = $values['totalTokens'] ?? null;
        $this->totalCookies = $values['totalCookies'] ?? null;
        $this->totalCreditCards = $values['totalCreditCards'] ?? null;
        $this->totalSize = $values['totalSize'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
