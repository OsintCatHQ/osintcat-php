<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class TiktokResolverResponse extends JsonSerializableType
{
    /**
     * @var ?bool $success `true` when resolved.
     */
    #[JsonProperty('success')]
    public ?bool $success;

    /**
     * @var ?array<string, mixed> $sharer The account that shared the link: `username`, `nickname`, `avatar`, `region`, `language`, `account_created`, `follower_count`, `following_count`, `heart_count`, `video_count`, `bio`, `verified`, `private`. `resolved_via` is `sec_uid` for the sharer, or `video_author` when only the video's author could be identified.
     */
    #[JsonProperty('sharer'), ArrayType(['string' => 'mixed'])]
    public ?array $sharer;

    /**
     * @var ?array<string, mixed> $shareInfo The share: `shared_from`, `share_time`, `device`, `language`, `region`, `account_created`.
     */
    #[JsonProperty('share_info'), ArrayType(['string' => 'mixed'])]
    public ?array $shareInfo;

    /**
     * @var ?array<string, mixed> $video The video: `full_url`, `video_id`, `video_created`, `type`, `author_username`.
     */
    #[JsonProperty('video'), ArrayType(['string' => 'mixed'])]
    public ?array $video;

    /**
     * @param array{
     *   success?: ?bool,
     *   sharer?: ?array<string, mixed>,
     *   shareInfo?: ?array<string, mixed>,
     *   video?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->success = $values['success'] ?? null;
        $this->sharer = $values['sharer'] ?? null;
        $this->shareInfo = $values['shareInfo'] ?? null;
        $this->video = $values['video'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
