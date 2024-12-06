<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use BaseCodeOy\BookmarkParser\SafariParser;

it('should parse the HTML export of bookmarks', function (): void {
    $content = <<<'HTML_WRAP'
<!DOCTYPE NETSCAPE-Bookmark-file-1>
    <HTML>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <Title>Bookmarks</Title>
    <H1>Bookmarks</H1>
    <DT><H3 FOLDED>Favourites</H3>
    <DL>
        <DT><A HREF="https://www.apple.com/">Apple</A>
        <DT><A HREF="https://www.icloud.com/">iCloud</A>
        <DT><A HREF="https://www.yahoo.com/">Yahoo</A>
        <DT><A HREF="https://www.bing.com/">Bing</A>
        <DT><A HREF="https://www.google.com/?client=safari&channel=mac_bm">Google</A>
        <DT><A HREF="https://www.wikipedia.org/">Wikipedia</A>
        <DT><A HREF="https://www.facebook.com/">Facebook</A>
        <DT><A HREF="https://twitter.com/">Twitter</A>
        <DT><A HREF="https://www.linkedin.com/">LinkedIn</A>
        <DT><A HREF="https://www.weather.com/">The Weather Channel</A>
        <DT><A HREF="https://www.yelp.com/">Yelp</A>
        <DT><A HREF="https://www.tripadvisor.com/">TripAdvisor</A>
    </DL>
    </DT>
</HTML>
HTML_WRAP;

    $bookmarks = (new SafariParser($content))->parse();

    expect($bookmarks[0]->getName())->toBe('Apple');
    expect($bookmarks[1]->getName())->toBe('iCloud');
    expect($bookmarks[2]->getName())->toBe('Yahoo');
    expect($bookmarks[3]->getName())->toBe('Bing');
    expect($bookmarks[4]->getName())->toBe('Google');
    expect($bookmarks[5]->getName())->toBe('Wikipedia');
    expect($bookmarks[6]->getName())->toBe('Facebook');
    expect($bookmarks[7]->getName())->toBe('Twitter');
    expect($bookmarks[8]->getName())->toBe('LinkedIn');
    expect($bookmarks[9]->getName())->toBe('The Weather Channel');
    expect($bookmarks[10]->getName())->toBe('Yelp');
    expect($bookmarks[11]->getName())->toBe('TripAdvisor');
});
