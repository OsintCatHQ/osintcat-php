<?php

namespace OsintCat\Chile\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class PersonChileRequest extends JsonSerializableType
{
    /**
     * @var string $query A full or partial name.
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
