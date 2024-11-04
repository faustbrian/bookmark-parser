<?php

declare(strict_types=1);

namespace BaseCodeOy\BookmarkParser;

use Carbon\CarbonImmutable;
use Symfony\Component\DomCrawler\Crawler;

final readonly class HtmlParser implements ParserInterface
{
    public function __construct(private readonly string $content)
    {
        //
    }

    /**
     * @return array<int, Bookmark>
     */
    public function parse(): array
    {
        return (new Crawler($this->content))
            ->filter('a[ADD_DATE]')
            ->each(fn (Crawler $linkNode): Bookmark => new Bookmark(
                name: $linkNode->innerText(),
                link: $linkNode->attr('href'),
                date: CarbonImmutable::createFromTimestamp($linkNode->attr('add_date')),
                base64Icon: $linkNode->attr('icon'),
            ));
    }
}
