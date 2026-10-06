<?php

namespace OsintCat\Tiktok\Requests;

use OsintCat\Core\Json\JsonSerializableType;

class ResolveShareLinkTiktokRequest extends JsonSerializableType
{
    /**
     * @var string $link A TikTok share link. `url` or `query` are accepted as well.
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
