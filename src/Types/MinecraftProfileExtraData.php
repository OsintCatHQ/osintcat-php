<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class MinecraftProfileExtraData extends JsonSerializableType
{
    /**
     * @var ?string $username Current username.
     */
    #[JsonProperty('Username')]
    public ?string $username;

    /**
     * @var ?string $uuid Minecraft UUID.
     */
    #[JsonProperty('UUID')]
    public ?string $uuid;

    /**
     * @var ?array<mixed> $nameHistory Earlier usernames.
     */
    #[JsonProperty('NameHistory'), ArrayType(['mixed'])]
    public ?array $nameHistory;

    /**
     * @var ?string $labyUsername Username shown by the LabyMod profile, if any.
     */
    #[JsonProperty('LabyUsername')]
    public ?string $labyUsername;

    /**
     * @var ?string $profilePicUrl Head render of the skin.
     */
    #[JsonProperty('ProfilePicUrl')]
    public ?string $profilePicUrl;

    /**
     * @param array{
     *   username?: ?string,
     *   uuid?: ?string,
     *   nameHistory?: ?array<mixed>,
     *   labyUsername?: ?string,
     *   profilePicUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->username = $values['username'] ?? null;
        $this->uuid = $values['uuid'] ?? null;
        $this->nameHistory = $values['nameHistory'] ?? null;
        $this->labyUsername = $values['labyUsername'] ?? null;
        $this->profilePicUrl = $values['profilePicUrl'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
