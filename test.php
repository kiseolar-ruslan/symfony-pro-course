<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$a = [
    'first' => [
        'a' => 1,
        'b' => 2,
        'c' => 3,
        'd' => [
            'nick',
            'name',
        ]
    ],
];

foreach ($a as $item) {
    echo $item['a'];
}
exit;