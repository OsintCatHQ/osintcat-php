<?php

namespace OsintCat\Minecraft\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class ProfileMinecraftRequest extends JsonSerializableType
{
    /**
     * @var string $username The Minecraft username.
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
