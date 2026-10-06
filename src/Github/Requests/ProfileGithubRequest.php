<?php

namespace OsintCat\Github\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class ProfileGithubRequest extends JsonSerializableType
{
    /**
     * @var string $username The GitHub username.
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
