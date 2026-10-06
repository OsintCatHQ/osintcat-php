<?php

namespace OsintCat\X\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class ProfileXRequest extends JsonSerializableType
{
    /**
     * @var string $query The X username, with or without `@`.
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
