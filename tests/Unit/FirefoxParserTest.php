<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use BaseCodeOy\BookmarkParser\Bookmark;
use BaseCodeOy\BookmarkParser\FirefoxParser;

it('should parse the SQLite database of Mozilla Firefox', function (): void {
    $bookmarks = (new FirefoxParser('/Users/brianfaust/Library/Application Support/Firefox/Profiles/7pilig34.default-release/places.sqlite'))->parse();

    expect($bookmarks[0])->toBeInstanceOf(Bookmark::class);
})->skip();
