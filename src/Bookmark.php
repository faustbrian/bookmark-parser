<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\BookmarkParser;

use Carbon\CarbonImmutable;

final readonly class Bookmark implements \JsonSerializable
{
    public function __construct(
        private string $name,
        private string $link,
        private CarbonImmutable $date,
        private ?string $base64Icon,
    ) {
        //
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getDate(): CarbonImmutable
    {
        return $this->date;
    }

    public function getBase64Icon(): string
    {
        return $this->base64Icon;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'link' => $this->link,
            'date' => $this->date->unix(),
        ];
    }

    #[\Override()]
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
