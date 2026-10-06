<?php

namespace OsintCat\Steam\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class ProfileSteamRequest extends JsonSerializableType
{
    /**
     * @var string $username The Steam username.
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
