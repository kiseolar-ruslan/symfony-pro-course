<?php

declare(strict_types=1);

namespace App\UrlConverter\Savers;

use App\ORM\ActiveRecord\Models\UrlCode;
use App\UrlConverter\Interfaces\ISaveData;
use InvalidArgumentException;

class ActiveRecordSaver implements ISaveData
{
    public function saveData(array $data): void
    {
        if (true === empty($data)) {
            throw new InvalidArgumentException();
        }

        $code = array_key_first($data);
        $url  = current($data);

        UrlCode::create([
            'code' => $code,
            'url'  => $url,
        ]);
    }
}