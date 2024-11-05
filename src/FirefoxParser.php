<?php

declare(strict_types=1);

namespace BaseCodeOy\BookmarkParser;

use Carbon\CarbonImmutable;
use SQLite3;

final readonly class FirefoxParser implements ParserInterface
{
    public function __construct(private readonly string $path)
    {
        //
    }

    /**
     * @return array<int, Bookmark>
     */
    public function parse(): array
    {
        $database = new SQLite3($this->path);
        $results = $database->query('SELECT h.url, b.title, b.dateAdded FROM moz_places h JOIN moz_bookmarks b ON h.id = b.fk;');

        $bookmarks = [];

        while ($row = $results->fetchArray()) {
            $bookmarks[] = new Bookmark(
                name: $row['title'] ?? '',
                link: $row['url'],
                date: CarbonImmutable::createFromTimestamp($row['dateAdded'] / 1000000),
                base64Icon: null,
            );
        }

        return $bookmarks;
    }
}
