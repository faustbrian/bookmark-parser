<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\BookmarkParser;

use Carbon\CarbonImmutable;

final readonly class FirefoxParser implements ParserInterface
{
    public function __construct(
        private readonly string $path,
    ) {
        //
    }

    /**
     * @return array<int, Bookmark>
     */
    #[\Override()]
    public function parse(): array
    {
        $sqLite3 = new \SQLite3($this->path);
        $results = $sqLite3->query('SELECT h.url, b.title, b.dateAdded FROM moz_places h JOIN moz_bookmarks b ON h.id = b.fk;');

        $bookmarks = [];

        while ($row = $results->fetchArray()) {
            $bookmarks[] = new Bookmark(
                name: $row['title'] ?? '',
                link: $row['url'],
                date: CarbonImmutable::createFromTimestamp($row['dateAdded'] / 1_000_000),
                base64Icon: null,
            );
        }

        return $bookmarks;
    }
}
