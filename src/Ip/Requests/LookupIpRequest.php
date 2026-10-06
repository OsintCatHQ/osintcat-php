<?php

namespace OsintCat\Ip\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class LookupIpRequest extends JsonSerializableType
{
    /**
     * @var string $query An IPv4 or IPv6 address.
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
