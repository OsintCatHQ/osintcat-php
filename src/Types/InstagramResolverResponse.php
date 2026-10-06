<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class InstagramResolverResponse extends JsonSerializableType
{
    /**
     * @var ?bool $success `true` when resolved.
     */
    #[JsonProperty('success')]
    public ?bool $success;

    /**
     * @var ?array<string, mixed> $author The account that posted it: `username`, `avatar`.
     */
    #[JsonProperty('author'), ArrayType(['string' => 'mixed'])]
    public ?array $author;

    /**
     * @var ?array<string, mixed> $sharer The account that shared the link: `username`, `full_name`, `id`, `avatar`.
     */
    #[JsonProperty('sharer'), ArrayType(['string' => 'mixed'])]
    public ?array $sharer;

    /**
     * @var ?string $entityId ID of the shared post.
     */
    #[JsonProperty('entity_id')]
    public ?string $entityId;

    /**
     * @var ?UsageMeta $meta
     */
    #[JsonProperty('_meta')]
    public ?UsageMeta $meta;

    /**
     * @param array{
     *   success?: ?bool,
     *   author?: ?array<string, mixed>,
     *   sharer?: ?array<string, mixed>,
     *   entityId?: ?string,
     *   meta?: ?UsageMeta,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->success = $values['success'] ?? null;
        $this->author = $values['author'] ?? null;
        $this->sharer = $values['sharer'] ?? null;
        $this->entityId = $values['entityId'] ?? null;
        $this->meta = $values['meta'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
