<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class ChessResponse extends JsonSerializableType
{
    /**
     * @var ?bool $success `true` when the lookup ran.
     */
    #[JsonProperty('success')]
    public ?bool $success;

    /**
     * @var ?bool $found Whether anything was found.
     */
    #[JsonProperty('found')]
    public ?bool $found;

    /**
     * @var ?string $query The query.
     */
    #[JsonProperty('query')]
    public ?string $query;

    /**
     * @var ?string $resolvedUsername The username the lookup settled on.
     */
    #[JsonProperty('resolved_username')]
    public ?string $resolvedUsername;

    /**
     * @var ?array<string, mixed> $liveProfile The public profile (name, country, joined, last online, followers ...), or `null`.
     */
    #[JsonProperty('live_profile'), ArrayType(['string' => 'mixed'])]
    public ?array $liveProfile;

    /**
     * @var ?array<string, mixed> $liveStats Ratings: `rapid`, `blitz`, `bullet`, `fide` (each `null` when unrated).
     */
    #[JsonProperty('live_stats'), ArrayType(['string' => 'mixed'])]
    public ?array $liveStats;

    /**
     * @var ?array<mixed> $liveClubs Up to 10 clubs.
     */
    #[JsonProperty('live_clubs'), ArrayType(['mixed'])]
    public ?array $liveClubs;

    /**
     * @var ?array<mixed> $leakRecords Records from the Chess.com leak.
     */
    #[JsonProperty('leak_records'), ArrayType(['mixed'])]
    public ?array $leakRecords;

    /**
     * @var ?float $leakCount Number of leak records.
     */
    #[JsonProperty('leak_count')]
    public ?float $leakCount;

    /**
     * @param array{
     *   success?: ?bool,
     *   found?: ?bool,
     *   query?: ?string,
     *   resolvedUsername?: ?string,
     *   liveProfile?: ?array<string, mixed>,
     *   liveStats?: ?array<string, mixed>,
     *   liveClubs?: ?array<mixed>,
     *   leakRecords?: ?array<mixed>,
     *   leakCount?: ?float,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->success = $values['success'] ?? null;
        $this->found = $values['found'] ?? null;
        $this->query = $values['query'] ?? null;
        $this->resolvedUsername = $values['resolvedUsername'] ?? null;
        $this->liveProfile = $values['liveProfile'] ?? null;
        $this->liveStats = $values['liveStats'] ?? null;
        $this->liveClubs = $values['liveClubs'] ?? null;
        $this->leakRecords = $values['leakRecords'] ?? null;
        $this->leakCount = $values['leakCount'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
