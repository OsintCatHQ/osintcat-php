<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class RedditExtraData extends JsonSerializableType
{
    /**
     * @var ?string $username Username.
     */
    #[JsonProperty('Username')]
    public ?string $username;

    /**
     * @var ?string $displayName Display name.
     */
    #[JsonProperty('DisplayName')]
    public ?string $displayName;

    /**
     * @var ?float $commentKarma Comment karma.
     */
    #[JsonProperty('CommentKarma')]
    public ?float $commentKarma;

    /**
     * @var ?float $linkKarma Post karma.
     */
    #[JsonProperty('LinkKarma')]
    public ?float $linkKarma;

    /**
     * @var ?float $totalKarma Total karma.
     */
    #[JsonProperty('TotalKarma')]
    public ?float $totalKarma;

    /**
     * @var ?float $createdAt Account creation (Unix time).
     */
    #[JsonProperty('CreatedAt')]
    public ?float $createdAt;

    /**
     * @var ?bool $isVerified Verified e-mail.
     */
    #[JsonProperty('IsVerified')]
    public ?bool $isVerified;

    /**
     * @var ?bool $isMod Moderates a community.
     */
    #[JsonProperty('IsMod')]
    public ?bool $isMod;

    /**
     * @var ?bool $isSuspended Present and `true` for suspended accounts.
     */
    #[JsonProperty('IsSuspended')]
    public ?bool $isSuspended;

    /**
     * @var ?string $profileUrl Profile link.
     */
    #[JsonProperty('ProfileUrl')]
    public ?string $profileUrl;

    /**
     * @param array{
     *   username?: ?string,
     *   displayName?: ?string,
     *   commentKarma?: ?float,
     *   linkKarma?: ?float,
     *   totalKarma?: ?float,
     *   createdAt?: ?float,
     *   isVerified?: ?bool,
     *   isMod?: ?bool,
     *   isSuspended?: ?bool,
     *   profileUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->username = $values['username'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->commentKarma = $values['commentKarma'] ?? null;
        $this->linkKarma = $values['linkKarma'] ?? null;
        $this->totalKarma = $values['totalKarma'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->isVerified = $values['isVerified'] ?? null;
        $this->isMod = $values['isMod'] ?? null;
        $this->isSuspended = $values['isSuspended'] ?? null;
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
