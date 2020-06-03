<?php
return [
    'search' => [
        'enabled' => env('SEARCH_ENABLED', false),
        'hosts' => explode(',', env('SEARCH_HOSTS')),
    ],
];
