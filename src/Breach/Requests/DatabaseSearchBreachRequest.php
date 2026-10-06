<?php

namespace OsintCat\Breach\Requests;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Breach\Types\DatabaseSearchBreachRequestType;

class DatabaseSearchBreachRequest extends JsonSerializableType
{
    /**
     * @var string $query The e-mail address or domain.
     */
    public string $query;

    /**
     * @var ?value-of<DatabaseSearchBreachRequestType> $queryType `email` or `domain`. Detected from `query` when left out.
     */
    public ?string $queryType;

    /**
     * @param array{
     *   query: string,
     *   queryType?: ?value-of<DatabaseSearchBreachRequestType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->query = $values['query'];
        $this->queryType = $values['queryType'] ?? null;
    }
}
