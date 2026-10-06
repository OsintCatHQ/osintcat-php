<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class TwitterResponse extends JsonSerializableType
{
    /**
     * @var ?string $status `success`.
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @var ?TwitterProfile $profile
     */
    #[JsonProperty('profile')]
    public ?TwitterProfile $profile;

    /**
     * @var ?float $recentTweetsScraped How many recent posts the summary is based on.
     */
    #[JsonProperty('recent_tweets_scraped')]
    public ?float $recentTweetsScraped;

    /**
     * @var ?array<string, mixed> $aiAnalysis The automated summary (interests, language, likely region, tone, activity pattern, authenticity estimate). Empty when no summary could be made.
     */
    #[JsonProperty('ai_analysis'), ArrayType(['string' => 'mixed'])]
    public ?array $aiAnalysis;

    /**
     * @param array{
     *   status?: ?string,
     *   profile?: ?TwitterProfile,
     *   recentTweetsScraped?: ?float,
     *   aiAnalysis?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->status = $values['status'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->recentTweetsScraped = $values['recentTweetsScraped'] ?? null;
        $this->aiAnalysis = $values['aiAnalysis'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
