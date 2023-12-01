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

//$test = [1, 2, 3, 4, 5];
//
//for ($i = 0; $i < count($test); $i++) {
//    echo $test[$i] . PHP_EOL;
//}

$urlConverter = new \App\UrlConverter\UrlAnywayConverter(
    new \App\UrlConverter\Repository\FileRepository(),
    new \App\UrlConverter\Savers\ToFileSaver(),
    new \App\UrlConverter\Validate\UrlValidator()
);

$a      = $urlConverter->encode('https://instagram.com');
$decode = $urlConverter->decode($a);
echo $a . PHP_EOL;
echo $decode . PHP_EOL;

