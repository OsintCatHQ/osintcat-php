<?php

namespace OsintCat\Chess\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class LookupChessRequest extends JsonSerializableType
{
    /**
     * @var string $query A Chess.com username or an e-mail address.
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
