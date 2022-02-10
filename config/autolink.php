<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Ignored Tags
    |--------------------------------------------------------------------------
    |
    */
    'ignored_tags' => [
        'a',
        'code',
        'kbd',
        'pre',
        'script',
    ],

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    |
    */
    'filters' => [
        \OsiemSiedem\Autolink\Filters\TrimFilter::class,
        \OsiemSiedem\Autolink\Filters\LimitLengthFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Parsers
    |--------------------------------------------------------------------------
    |
    */
    'parsers' => [
		\App\Autolink\YouTubeParser::class,
        \OsiemSiedem\Autolink\Parsers\UrlParser::class,
        \OsiemSiedem\Autolink\Parsers\WwwParser::class,
        \OsiemSiedem\Autolink\Parsers\EmailParser::class,
    ],
];
