<?php

namespace OsintCat\Breach\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class DomainBreachRequest extends JsonSerializableType
{
    /**
     * @var string $query The domain, e.g. `example.com`.
     */
    public string $query;

    /**
     * @param array{
     *   query: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->query = $values['query'];
    }
}
