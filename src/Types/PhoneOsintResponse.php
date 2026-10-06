<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class PhoneOsintResponse extends JsonSerializableType
{
    /**
     * @var ?string $module Always `phone`.
     */
    #[JsonProperty('module')]
    public ?string $module;

    /**
     * @var ?string $query The number in E.164 format.
     */
    #[JsonProperty('query')]
    public ?string $query;

    /**
     * @var ?bool $found Whether anything was found.
     */
    #[JsonProperty('found')]
    public ?bool $found;

    /**
     * @var ?PhoneOsintRisk $risk
     */
    #[JsonProperty('risk')]
    public ?PhoneOsintRisk $risk;

    /**
     * @var ?array<mixed> $summary The main facts as `{label, value}` pairs.
     */
    #[JsonProperty('summary'), ArrayType(['mixed'])]
    public ?array $summary;

    /**
     * @var ?array<mixed> $sections Detailed findings, grouped (carrier, location, linked accounts ...).
     */
    #[JsonProperty('sections'), ArrayType(['mixed'])]
    public ?array $sections;

    /**
     * @var ?array<string, mixed> $raw The full answer the summary is built from.
     */
    #[JsonProperty('raw'), ArrayType(['string' => 'mixed'])]
    public ?array $raw;

    /**
     * @var ?UsageMeta $meta
     */
    #[JsonProperty('_meta')]
    public ?UsageMeta $meta;

    /**
     * @param array{
     *   module?: ?string,
     *   query?: ?string,
     *   found?: ?bool,
     *   risk?: ?PhoneOsintRisk,
     *   summary?: ?array<mixed>,
     *   sections?: ?array<mixed>,
     *   raw?: ?array<string, mixed>,
     *   meta?: ?UsageMeta,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->module = $values['module'] ?? null;
        $this->query = $values['query'] ?? null;
        $this->found = $values['found'] ?? null;
        $this->risk = $values['risk'] ?? null;
        $this->summary = $values['summary'] ?? null;
        $this->sections = $values['sections'] ?? null;
        $this->raw = $values['raw'] ?? null;
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
