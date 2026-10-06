<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

class MachineFileInfo extends JsonSerializableType
{
    /**
     * @var ?string $id
     */
    #[JsonProperty('id')]
    public ?string $id;

    /**
     * @var ?string $machineId
     */
    #[JsonProperty('machine_id')]
    public ?string $machineId;

    /**
     * @var ?string $machineName
     */
    #[JsonProperty('machine_name')]
    public ?string $machineName;

    /**
     * @var ?string $path
     */
    #[JsonProperty('path')]
    public ?string $path;

    /**
     * @var ?string $filename
     */
    #[JsonProperty('filename')]
    public ?string $filename;

    /**
     * @var ?int $size
     */
    #[JsonProperty('size')]
    public ?int $size;

    /**
     * @var ?string $content The file content as text.
     */
    #[JsonProperty('content')]
    public ?string $content;

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
     *   machineId?: ?string,
     *   machineName?: ?string,
     *   path?: ?string,
     *   filename?: ?string,
     *   size?: ?int,
     *   content?: ?string,
     *   isPasswordFile?: ?bool,
     *   isTokenFile?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->machineId = $values['machineId'] ?? null;
        $this->machineName = $values['machineName'] ?? null;
        $this->path = $values['path'] ?? null;
        $this->filename = $values['filename'] ?? null;
        $this->size = $values['size'] ?? null;
        $this->content = $values['content'] ?? null;
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
