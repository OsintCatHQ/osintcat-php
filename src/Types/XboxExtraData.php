<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class XboxExtraData extends JsonSerializableType
{
    /**
     * @var ?string $gamertag Gamertag.
     */
    #[JsonProperty('Gamertag')]
    public ?string $gamertag;

    /**
     * @var ?string $xuid Xbox user ID.
     */
    #[JsonProperty('XUID')]
    public ?string $xuid;

    /**
     * @var ?string $profileUrl Profile link.
     */
    #[JsonProperty('ProfileUrl')]
    public ?string $profileUrl;

    /**
     * @var ?string $avatarUrl Gamer picture.
     */
    #[JsonProperty('AvatarUrl')]
    public ?string $avatarUrl;

    /**
     * @var ?string $gamerScore Gamerscore.
     */
    #[JsonProperty('GamerScore')]
    public ?string $gamerScore;

    /**
     * @var ?string $accountTier Account tier.
     */
    #[JsonProperty('AccountTier')]
    public ?string $accountTier;

    /**
     * @var ?string $bio Bio.
     */
    #[JsonProperty('Bio')]
    public ?string $bio;

    /**
     * @var ?string $location Location, if set.
     */
    #[JsonProperty('Location')]
    public ?string $location;

    /**
     * @var ?string $tenure Years of membership.
     */
    #[JsonProperty('Tenure')]
    public ?string $tenure;

    /**
     * @var ?bool $isVerified Verified account.
     */
    #[JsonProperty('IsVerified')]
    public ?bool $isVerified;

    /**
     * @param array{
     *   gamertag?: ?string,
     *   xuid?: ?string,
     *   profileUrl?: ?string,
     *   avatarUrl?: ?string,
     *   gamerScore?: ?string,
     *   accountTier?: ?string,
     *   bio?: ?string,
     *   location?: ?string,
     *   tenure?: ?string,
     *   isVerified?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->gamertag = $values['gamertag'] ?? null;
        $this->xuid = $values['xuid'] ?? null;
        $this->profileUrl = $values['profileUrl'] ?? null;
        $this->avatarUrl = $values['avatarUrl'] ?? null;
        $this->gamerScore = $values['gamerScore'] ?? null;
        $this->accountTier = $values['accountTier'] ?? null;
        $this->bio = $values['bio'] ?? null;
        $this->location = $values['location'] ?? null;
        $this->tenure = $values['tenure'] ?? null;
        $this->isVerified = $values['isVerified'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
