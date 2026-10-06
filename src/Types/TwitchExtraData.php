<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class TwitchExtraData extends JsonSerializableType
{
    /**
     * @var ?string $username Login name.
     */
    #[JsonProperty('Username')]
    public ?string $username;

    /**
     * @var ?string $displayName Display name.
     */
    #[JsonProperty('DisplayName')]
    public ?string $displayName;

    /**
     * @var ?string $userId Twitch user ID.
     */
    #[JsonProperty('UserID')]
    public ?string $userId;

    /**
     * @var ?string $description Bio.
     */
    #[JsonProperty('Description')]
    public ?string $description;

    /**
     * @var ?string $profilePicUrl Profile picture.
     */
    #[JsonProperty('ProfilePicUrl')]
    public ?string $profilePicUrl;

    /**
     * @var ?float $followers Followers.
     */
    #[JsonProperty('Followers')]
    public ?float $followers;

    /**
     * @var ?string $createdAt Account creation.
     */
    #[JsonProperty('CreatedAt')]
    public ?string $createdAt;

    /**
     * @var ?string $broadcasterType `partner`, `affiliate` or empty.
     */
    #[JsonProperty('BroadcasterType')]
    public ?string $broadcasterType;

    /**
     * @var ?bool $banned Whether the account is suspended (`BanReason` then says why).
     */
    #[JsonProperty('Banned')]
    public ?bool $banned;

    /**
     * @var ?bool $isPartner Twitch partner.
     */
    #[JsonProperty('IsPartner')]
    public ?bool $isPartner;

    /**
     * @var ?bool $isAffiliate Twitch affiliate.
     */
    #[JsonProperty('IsAffiliate')]
    public ?bool $isAffiliate;

    /**
     * @var ?string $profileUrl Channel link.
     */
    #[JsonProperty('ProfileUrl')]
    public ?string $profileUrl;

    /**
     * @param array{
     *   username?: ?string,
     *   displayName?: ?string,
     *   userId?: ?string,
     *   description?: ?string,
     *   profilePicUrl?: ?string,
     *   followers?: ?float,
     *   createdAt?: ?string,
     *   broadcasterType?: ?string,
     *   banned?: ?bool,
     *   isPartner?: ?bool,
     *   isAffiliate?: ?bool,
     *   profileUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->username = $values['username'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->profilePicUrl = $values['profilePicUrl'] ?? null;
        $this->followers = $values['followers'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->broadcasterType = $values['broadcasterType'] ?? null;
        $this->banned = $values['banned'] ?? null;
        $this->isPartner = $values['isPartner'] ?? null;
        $this->isAffiliate = $values['isAffiliate'] ?? null;
        $this->profileUrl = $values['profileUrl'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
