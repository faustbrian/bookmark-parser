<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\BookmarkParser;

use Carbon\CarbonImmutable;

final readonly class GoogleChromeParser implements ParserInterface
{
    public function __construct(
        private readonly string $content,
    ) {
        //
    }

    /**
     * @throws \JsonException
     *
     * @return array<int, Bookmark>
     */
    public function parse(): array
    {
        $roots = \json_decode($this->content, true, \JSON_THROW_ON_ERROR)['roots'];
        $bookmarks = [];

        foreach ($roots as $root) {
            $this->parseNode($root, $bookmarks);
        }

        return $bookmarks;
    }

    private function parseNode(array $node, array &$bookmarks): void
    {
        if ($node['type'] === 'url') {
            $bookmarks[] = new Bookmark(
                name: $node['name'],
                link: $node['url'],
                date: CarbonImmutable::createFromDate(1_601, 1, 1, 'UTC')->addSeconds($node['date_added'] / 1_000_000),
                base64Icon: null,
            );
        }

        if ($node['type'] === 'folder' && \array_key_exists('children', $node)) {
            foreach ($node['children'] as $child) {
                $this->parseNode($child, $bookmarks);
            }
        }
    }
}
