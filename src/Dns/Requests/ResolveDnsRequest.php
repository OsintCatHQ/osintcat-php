<?php

namespace OsintCat\Dns\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class ResolveDnsRequest extends JsonSerializableType
{
    /**
     * @var string $query A hostname, or several separated by commas.
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
