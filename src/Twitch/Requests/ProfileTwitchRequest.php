<?php

namespace OsintCat\Twitch\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class ProfileTwitchRequest extends JsonSerializableType
{
    /**
     * @var string $username The Twitch username.
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
