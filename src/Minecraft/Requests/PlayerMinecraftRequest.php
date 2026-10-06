<?php

namespace OsintCat\Minecraft\Requests;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Minecraft\Types\PlayerMinecraftRequestType;

class PlayerMinecraftRequest extends JsonSerializableType
{
    /**
     * @var string $query A Minecraft username (or the value matching `type`).
     */
    public string $query;

    /**
     * @var ?value-of<PlayerMinecraftRequestType> $queryType What `query` is for the leak search: `username` (default), `uuid`, `email` or `ip`.
     */
    public ?string $queryType;

    /**
     * @param array{
     *   query: string,
     *   queryType?: ?value-of<PlayerMinecraftRequestType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->query = $values['query'];
        $this->queryType = $values['queryType'] ?? null;
    }
}
