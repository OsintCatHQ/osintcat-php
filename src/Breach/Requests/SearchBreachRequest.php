<?php

namespace OsintCat\Breach\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class SearchBreachRequest extends JsonSerializableType
{
    /**
     * @var string $query What to search for: an e-mail address, username, domain, phone number, IP address, name or password.
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
