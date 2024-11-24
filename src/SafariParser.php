<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\BookmarkParser;

use Carbon\CarbonImmutable;
use Symfony\Component\DomCrawler\Crawler;

final readonly class SafariParser implements ParserInterface
{
    public function __construct(
        private readonly string $content,
    ) {
        //
    }

    /**
     * @return array<int, Bookmark>
     */
    public function parse(): array
    {
        $date = CarbonImmutable::now();

        return (new Crawler($this->content))
            ->filter('a')
            ->each(fn (Crawler $linkNode): Bookmark => new Bookmark(
                name: $linkNode->innerText(),
                link: $linkNode->attr('href'),
                date: $date,
                base64Icon: null,
            ));
    }
}
