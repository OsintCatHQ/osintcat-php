<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class Machine extends JsonSerializableType
{
    /**
     * @var ?string $id Machine ID (a UUID).
     */
    #[JsonProperty('id')]
    public ?string $id;

    /**
     * @var ?string $name Name of the log the machine came from.
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $importedAt When it was added (ISO 8601).
     */
    #[JsonProperty('imported_at')]
    public ?string $importedAt;

    /**
     * @var ?string $country Country code, if known.
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?string $ip IP address, if known.
     */
    #[JsonProperty('ip')]
    public ?string $ip;

    /**
     * @var ?int $fileCount
     */
    #[JsonProperty('file_count')]
    public ?int $fileCount;

    /**
     * @var ?int $totalSize Size of all files, in bytes.
     */
    #[JsonProperty('total_size')]
    public ?int $totalSize;

    /**
     * @var ?bool $hasPasswords
     */
    #[JsonProperty('has_passwords')]
    public ?bool $hasPasswords;

    /**
     * @var ?int $passwordCount
     */
    #[JsonProperty('password_count')]
    public ?int $passwordCount;

    /**
     * @var ?int $uniquePasswordCount
     */
    #[JsonProperty('unique_password_count')]
    public ?int $uniquePasswordCount;

    /**
     * @var ?bool $hasTokens
     */
    #[JsonProperty('has_tokens')]
    public ?bool $hasTokens;

    /**
     * @var ?int $tokenCount
     */
    #[JsonProperty('token_count')]
    public ?int $tokenCount;

    /**
     * @var ?bool $hasCookies
     */
    #[JsonProperty('has_cookies')]
    public ?bool $hasCookies;

    /**
     * @var ?int $cookieCount
     */
    #[JsonProperty('cookie_count')]
    public ?int $cookieCount;

    /**
     * @var ?bool $hasCreditCards
     */
    #[JsonProperty('has_credit_cards')]
    public ?bool $hasCreditCards;

    /**
     * @var ?int $creditCardCount
     */
    #[JsonProperty('credit_card_count')]
    public ?int $creditCardCount;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   importedAt?: ?string,
     *   country?: ?string,
     *   ip?: ?string,
     *   fileCount?: ?int,
     *   totalSize?: ?int,
     *   hasPasswords?: ?bool,
     *   passwordCount?: ?int,
     *   uniquePasswordCount?: ?int,
     *   hasTokens?: ?bool,
     *   tokenCount?: ?int,
     *   hasCookies?: ?bool,
     *   cookieCount?: ?int,
     *   hasCreditCards?: ?bool,
     *   creditCardCount?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->importedAt = $values['importedAt'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->ip = $values['ip'] ?? null;
        $this->fileCount = $values['fileCount'] ?? null;
        $this->totalSize = $values['totalSize'] ?? null;
        $this->hasPasswords = $values['hasPasswords'] ?? null;
        $this->passwordCount = $values['passwordCount'] ?? null;
        $this->uniquePasswordCount = $values['uniquePasswordCount'] ?? null;
        $this->hasTokens = $values['hasTokens'] ?? null;
        $this->tokenCount = $values['tokenCount'] ?? null;
        $this->hasCookies = $values['hasCookies'] ?? null;
        $this->cookieCount = $values['cookieCount'] ?? null;
        $this->hasCreditCards = $values['hasCreditCards'] ?? null;
        $this->creditCardCount = $values['creditCardCount'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
