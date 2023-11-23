<?php

declare(strict_types=1);

namespace App\Services\Factory;

use App\Entity\UrlCode;

class UrlCodeEntityFactory implements FactoryInterface
{
    public function create(array $data): UrlCode
    {
        $code = array_key_first($data);
        $url  = current($data);

        return new UrlCode($url, $code);
    }
}