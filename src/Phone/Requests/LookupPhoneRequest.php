<?php

namespace OsintCat\Phone\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class LookupPhoneRequest extends JsonSerializableType
{
    /**
     * @var string $query The phone number in international format, e.g. `+4915112345678`. Spaces and dashes are allowed.
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
