<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class MachineFile extends JsonSerializableType
{
    /**
     * @var ?string $id File ID, for the file endpoints.
     */
    #[JsonProperty('id')]
    public ?string $id;

    /**
     * @var ?string $name File name.
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $path Path inside the log.
     */
    #[JsonProperty('path')]
    public ?string $path;

    /**
     * @var ?int $size Size in bytes.
     */
    #[JsonProperty('size')]
    public ?int $size;

    /**
     * @var ?string $fileType Always `file`.
     */
    #[JsonProperty('type')]
    public ?string $fileType;

    /**
     * @var ?bool $isPasswordFile
     */
    #[JsonProperty('is_password_file')]
    public ?bool $isPasswordFile;

    /**
     * @var ?bool $isTokenFile
     */
    #[JsonProperty('is_token_file')]
    public ?bool $isTokenFile;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   path?: ?string,
     *   size?: ?int,
     *   fileType?: ?string,
     *   isPasswordFile?: ?bool,
     *   isTokenFile?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->path = $values['path'] ?? null;
        $this->size = $values['size'] ?? null;
        $this->fileType = $values['fileType'] ?? null;
        $this->isPasswordFile = $values['isPasswordFile'] ?? null;
        $this->isTokenFile = $values['isTokenFile'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
