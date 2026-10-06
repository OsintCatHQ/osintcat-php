<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;
use OsintCat\Core\Types\ArrayType;

class IpResponse extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $ipleaks Services seen on the address: open ports, banners, hostnames, known vulnerabilities. `{"error": "No information available for that IP."}` when nothing was seen.
     */
    #[JsonProperty('ipleaks'), ArrayType(['string' => 'mixed'])]
    public ?array $ipleaks;

    /**
     * @var ?array<string, mixed> $ipinfo Location and network: country, region, city, coordinates, time zone, ASN and organisation.
     */
    #[JsonProperty('ipinfo'), ArrayType(['string' => 'mixed'])]
    public ?array $ipinfo;

    /**
     * @param array{
     *   ipleaks?: ?array<string, mixed>,
     *   ipinfo?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ipleaks = $values['ipleaks'] ?? null;
        $this->ipinfo = $values['ipinfo'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
