<?php

namespace OsintCat\Email\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class LookupEmailRequest extends JsonSerializableType
{
    /**
     * @var string $query The e-mail address (`email` is accepted as well).
     */
    public string $query;

    /**
     * @var string $purpose Why you run the lookup, e.g. `fraud prevention`. Required unless sent as a header (below).
     */
    public string $purpose;

    /**
     * @param array{
     *   query: string,
     *   purpose: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->query = $values['query'];
        $this->purpose = $values['purpose'];
    }
}
