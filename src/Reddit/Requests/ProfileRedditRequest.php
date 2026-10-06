<?php

namespace OsintCat\Reddit\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class ProfileRedditRequest extends JsonSerializableType
{
    /**
     * @var string $username The Reddit username.
     */
    public string $username;

    /**
     * @param array{
     *   username: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->username = $values['username'];
    }
}
