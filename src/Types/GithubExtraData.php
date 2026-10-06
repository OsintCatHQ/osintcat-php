<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class GithubExtraData extends JsonSerializableType
{
    /**
     * @var ?string $username Login.
     */
    #[JsonProperty('Username')]
    public ?string $username;

    /**
     * @var ?string $name Name.
     */
    #[JsonProperty('Name')]
    public ?string $name;

    /**
     * @var ?string $bio Bio.
     */
    #[JsonProperty('Bio')]
    public ?string $bio;

    /**
     * @var ?string $location Location.
     */
    #[JsonProperty('Location')]
    public ?string $location;

    /**
     * @var ?string $company Company.
     */
    #[JsonProperty('Company')]
    public ?string $company;

    /**
     * @var ?string $blog Website.
     */
    #[JsonProperty('Blog')]
    public ?string $blog;

    /**
     * @var ?string $email Public e-mail.
     */
    #[JsonProperty('Email')]
    public ?string $email;

    /**
     * @var ?string $twitter X/Twitter handle.
     */
    #[JsonProperty('Twitter')]
    public ?string $twitter;

    /**
     * @var ?float $followers Followers.
     */
    #[JsonProperty('Followers')]
    public ?float $followers;

    /**
     * @var ?float $following Following.
     */
    #[JsonProperty('Following')]
    public ?float $following;

    /**
     * @var ?float $publicRepos Public repositories.
     */
    #[JsonProperty('PublicRepos')]
    public ?float $publicRepos;

    /**
     * @var ?string $createdAt Account creation.
     */
    #[JsonProperty('CreatedAt')]
    public ?string $createdAt;

    /**
     * @var ?string $profileUrl Profile link.
     */
    #[JsonProperty('ProfileUrl')]
    public ?string $profileUrl;

    /**
     * @var ?array<mixed> $repositories The 10 most recently pushed repositories (name, description, url, language, stars, forks).
     */
    #[JsonProperty('Repositories'), ArrayType(['mixed'])]
    public ?array $repositories;

    /**
     * @param array{
     *   username?: ?string,
     *   name?: ?string,
     *   bio?: ?string,
     *   location?: ?string,
     *   company?: ?string,
     *   blog?: ?string,
     *   email?: ?string,
     *   twitter?: ?string,
     *   followers?: ?float,
     *   following?: ?float,
     *   publicRepos?: ?float,
     *   createdAt?: ?string,
     *   profileUrl?: ?string,
     *   repositories?: ?array<mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->username = $values['username'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->bio = $values['bio'] ?? null;
        $this->location = $values['location'] ?? null;
        $this->company = $values['company'] ?? null;
        $this->blog = $values['blog'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->twitter = $values['twitter'] ?? null;
        $this->followers = $values['followers'] ?? null;
        $this->following = $values['following'] ?? null;
        $this->publicRepos = $values['publicRepos'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->profileUrl = $values['profileUrl'] ?? null;
        $this->repositories = $values['repositories'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
