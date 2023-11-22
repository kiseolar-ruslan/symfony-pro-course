<?php

declare(strict_types=1);

namespace App\UrlConverter\Savers;

use App\UrlConverter\Interfaces\ISaveData;
use InvalidArgumentException;

class ToFileSaver implements ISaveData
{
    protected const FILE_NAME = 'url.json';

    public function saveData(array $data): void
    {
        if (file_exists(self::FILE_NAME) === false) {
            $steam = fopen(self::FILE_NAME, 'w');
            fclose($steam);
        }

        $currentData = file_get_contents(self::FILE_NAME);

        if ($currentData === false) {
            throw new InvalidArgumentException("Failed to read data from file self::FILE_NAME");
        }

        $mergedData = array_merge(json_decode($currentData, true) ?? [], $data);

        $steam = fopen(self::FILE_NAME, 'w+');

        if ($steam === false) {
            throw new InvalidArgumentException("Failed to open file " . self::FILE_NAME);
        }

        $jsonFormat = json_encode($mergedData, JSON_PRETTY_PRINT);

        if ($jsonFormat === false) {
            throw new InvalidArgumentException("Failed to encode data to JSON");
        }

        fwrite($steam, $jsonFormat);
        fclose($steam);
    }
}