<?php

declare(strict_types=1);

namespace App\UrlConverter\Repository;

use App\ORM\ActiveRecord\Models\UrlCode;
use App\UrlConverter\Interfaces\ICodeRepository;
use InvalidArgumentException;

class ActiveRecordRepository implements ICodeRepository
{
    public function codeIsset(string $code): bool
    {
        if (false === UrlCode::query()->where("code", $code)->exists()) {
            return false;
        }

        return true;
    }

    public function getUrlByCode(string $code): string
    {
        $url = UrlCode::query()->where("code", $code)->value("url");

        if (false === isset($url)) {
            throw new InvalidArgumentException();
        }

        return $url;
    }

    public function getCodeByUrl(string $url): string
    {
        $code = UrlCode::query()->where("url", $url)->value("code");

        if (false === isset($code)) {
            throw new InvalidArgumentException();
        }

        return $code;
    }
}