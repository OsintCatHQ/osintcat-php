<?php

namespace OsintCat\Chile\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class VehicleChileRequest extends JsonSerializableType
{
    /**
     * @var string $query The licence plate.
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
