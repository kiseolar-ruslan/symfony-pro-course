<?php

declare(strict_types=1);

namespace App\UrlConverter;

use App\UrlConverter\UrlConverter;

class UrlAnywayConverter extends UrlConverter
{
    public function encode(string $url): string
    {
        $this->validateUrl($url);
        return $this->generateAndSaveCode($url);
    }
}