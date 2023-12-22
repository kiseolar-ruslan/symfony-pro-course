<?php

declare(strict_types=1);

namespace App\Services\Factory;

use App\Entity\UrlCode;
use App\Entity\User;

class UrlCodeFactory
{
    public function create(array $data, User $user): UrlCode
    {
        $code = array_key_first($data);
        $url  = current($data);

        return new UrlCode($url, $code, $user);
    }
}