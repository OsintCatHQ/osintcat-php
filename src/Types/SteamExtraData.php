<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class SteamExtraData extends JsonSerializableType
{
    /**
     * @var ?string $username Steam username.
     */
    #[JsonProperty('Username')]
    public ?string $username;

    /**
     * @var ?string $displayName Profile name.
     */
    #[JsonProperty('DisplayName')]
    public ?string $displayName;

    /**
     * @var ?string $realName Real name, if public.
     */
    #[JsonProperty('RealName')]
    public ?string $realName;

    /**
     * @var ?string $profileUrl Profile link.
     */
    #[JsonProperty('ProfileUrl')]
    public ?string $profileUrl;

    /**
     * @var ?string $avatarUrl Avatar.
     */
    #[JsonProperty('AvatarUrl')]
    public ?string $avatarUrl;

    /**
     * @var ?float $profileState 1 when the profile is set up.
     */
    #[JsonProperty('ProfileState')]
    public ?float $profileState;

    /**
     * @var ?float $visibility 3 = public, 1 = private.
     */
    #[JsonProperty('Visibility')]
    public ?float $visibility;

    /**
     * @var ?float $timeCreated Account creation (Unix time).
     */
    #[JsonProperty('TimeCreated')]
    public ?float $timeCreated;

    /**
     * @var ?float $lastLogoff Last sign-off (Unix time).
     */
    #[JsonProperty('LastLogoff')]
    public ?float $lastLogoff;

    /**
     * @var ?string $countryCode Country, if public.
     */
    #[JsonProperty('CountryCode')]
    public ?string $countryCode;

    /**
     * @param array{
     *   username?: ?string,
     *   displayName?: ?string,
     *   realName?: ?string,
     *   profileUrl?: ?string,
     *   avatarUrl?: ?string,
     *   profileState?: ?float,
     *   visibility?: ?float,
     *   timeCreated?: ?float,
     *   lastLogoff?: ?float,
     *   countryCode?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->username = $values['username'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->realName = $values['realName'] ?? null;
        $this->profileUrl = $values['profileUrl'] ?? null;
        $this->avatarUrl = $values['avatarUrl'] ?? null;
        $this->profileState = $values['profileState'] ?? null;
        $this->visibility = $values['visibility'] ?? null;
        $this->timeCreated = $values['timeCreated'] ?? null;
        $this->lastLogoff = $values['lastLogoff'] ?? null;
        $this->countryCode = $values['countryCode'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
