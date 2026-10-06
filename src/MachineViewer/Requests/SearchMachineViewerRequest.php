<?php

namespace OsintCat\MachineViewer\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class SearchMachineViewerRequest extends JsonSerializableType
{
    /**
     * @var string $query What to search for: a name, username, hostname or machine ID.
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
