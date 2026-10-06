<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class TwitterProfile extends JsonSerializableType
{
    /**
     * @var ?string $id Account ID.
     */
    #[JsonProperty('id')]
    public ?string $id;

    /**
     * @var ?string $username Handle.
     */
    #[JsonProperty('username')]
    public ?string $username;

    /**
     * @var ?string $name Display name.
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $createdAt Account creation.
     */
    #[JsonProperty('created_at')]
    public ?string $createdAt;

    /**
     * @var ?float $followers Followers.
     */
    #[JsonProperty('followers')]
    public ?float $followers;

    /**
     * @var ?float $following Following.
     */
    #[JsonProperty('following')]
    public ?float $following;

    /**
     * @var ?float $tweetsCount Posts.
     */
    #[JsonProperty('tweets_count')]
    public ?float $tweetsCount;

    /**
     * @var ?string $description Bio.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?string $profileImage Profile picture.
     */
    #[JsonProperty('profile_image')]
    public ?string $profileImage;

    /**
     * @var ?string $bannerImage Banner.
     */
    #[JsonProperty('banner_image')]
    public ?string $bannerImage;

    /**
     * @var ?bool $verified Verified.
     */
    #[JsonProperty('verified')]
    public ?bool $verified;

    /**
     * @param array{
     *   id?: ?string,
     *   username?: ?string,
     *   name?: ?string,
     *   createdAt?: ?string,
     *   followers?: ?float,
     *   following?: ?float,
     *   tweetsCount?: ?float,
     *   description?: ?string,
     *   profileImage?: ?string,
     *   bannerImage?: ?string,
     *   verified?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->username = $values['username'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->followers = $values['followers'] ?? null;
        $this->following = $values['following'] ?? null;
        $this->tweetsCount = $values['tweetsCount'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->profileImage = $values['profileImage'] ?? null;
        $this->bannerImage = $values['bannerImage'] ?? null;
        $this->verified = $values['verified'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
