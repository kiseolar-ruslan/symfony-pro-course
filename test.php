<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$a = [
    [
        'a' => 1,
        'b' => 2,
        'c' => 3,
        'd' => [
            'nick',
            'name',
        ]
    ],
];

//foreach ($a as $item) {
//    echo $item['c'];
//}

$test = [1, 2, 3, 4, 5];

for ($i = 0; $i < count($test); $i++) {
    echo $test[$i] . PHP_EOL;
}
