<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class MinecraftResponse extends JsonSerializableType
{
    /**
     * @var ?string $query The query.
     */
    #[JsonProperty('query')]
    public ?string $query;

    /**
     * @var ?string $uuid Minecraft UUID, or `null`.
     */
    #[JsonProperty('uuid')]
    public ?string $uuid;

    /**
     * @var ?string $username Current username, or `null`.
     */
    #[JsonProperty('username')]
    public ?string $username;

    /**
     * @var ?array<mixed> $nameHistory Earlier usernames.
     */
    #[JsonProperty('name-history'), ArrayType(['mixed'])]
    public ?array $nameHistory;

    /**
     * @var ?array<mixed> $capes Capes on the account.
     */
    #[JsonProperty('capes'), ArrayType(['mixed'])]
    public ?array $capes;

    /**
     * @var ?array<mixed> $skinHistory Skins the account has used.
     */
    #[JsonProperty('skinHistory'), ArrayType(['mixed'])]
    public ?array $skinHistory;

    /**
     * @var mixed $results Records from Minecraft server leaks; `{"error": ...}` when the leak search was unavailable.
     */
    #[JsonProperty('results')]
    public mixed $results;

    /**
     * @param array{
     *   query?: ?string,
     *   uuid?: ?string,
     *   username?: ?string,
     *   nameHistory?: ?array<mixed>,
     *   capes?: ?array<mixed>,
     *   skinHistory?: ?array<mixed>,
     *   results?: mixed,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->query = $values['query'] ?? null;
        $this->uuid = $values['uuid'] ?? null;
        $this->username = $values['username'] ?? null;
        $this->nameHistory = $values['nameHistory'] ?? null;
        $this->capes = $values['capes'] ?? null;
        $this->skinHistory = $values['skinHistory'] ?? null;
        $this->results = $values['results'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
