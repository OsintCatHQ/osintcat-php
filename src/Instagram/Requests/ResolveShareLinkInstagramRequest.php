<?php

namespace OsintCat\Instagram\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class ResolveShareLinkInstagramRequest extends JsonSerializableType
{
    /**
     * @var string $link An Instagram post or reel share link (with its `igsh` parameter). `url` or `query` are accepted as well.
     */
    public string $link;

    /**
     * @param array{
     *   link: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->link = $values['link'];
    }
}
