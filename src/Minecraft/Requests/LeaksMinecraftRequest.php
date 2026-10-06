<?php

namespace OsintCat\Minecraft\Requests;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Minecraft\Types\LeaksMinecraftRequestType;

class LeaksMinecraftRequest extends JsonSerializableType
{
    /**
     * @var string $query The value to search for.
     */
    public string $query;

    /**
     * @var value-of<LeaksMinecraftRequestType> $queryType One of `username`, `uuid`, `email`, `ip`, `password`.
     */
    public string $queryType;

    /**
     * @param array{
     *   query: string,
     *   queryType: value-of<LeaksMinecraftRequestType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->query = $values['query'];
        $this->queryType = $values['queryType'];
    }
}
