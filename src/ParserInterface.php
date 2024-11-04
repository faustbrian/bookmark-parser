<?php

declare(strict_types=1);

namespace BaseCodeOy\BookmarkParser;

interface ParserInterface
{
    public function parse(): array;
}
