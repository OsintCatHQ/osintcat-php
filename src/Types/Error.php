<?php

namespace OsintCat\Types;

use OsintCat\Core\Json\JsonSerializableType;
use OsintCat\Core\Json\JsonProperty;

/**
 * What every error response carries. `error` is a short code or message; some errors add more fields (`error_id`, `code`, `allowed_types`).
 */
class Error extends JsonSerializableType
{
    /**
     * @var ?string $error
     */
    #[JsonProperty('error')]
    public ?string $error;

    /**
     * @var ?string $message
     */
    #[JsonProperty('message')]
    public ?string $message;

    /**
     * @var ?string $errorId Quote it to support.
     */
    #[JsonProperty('error_id')]
    public ?string $errorId;

    /**
     * @var ?string $code
     */
    #[JsonProperty('code')]
    public ?string $code;

    /**
     * @param array{
     *   error?: ?string,
     *   message?: ?string,
     *   errorId?: ?string,
     *   code?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->error = $values['error'] ?? null;
        $this->message = $values['message'] ?? null;
        $this->errorId = $values['errorId'] ?? null;
        $this->code = $values['code'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
