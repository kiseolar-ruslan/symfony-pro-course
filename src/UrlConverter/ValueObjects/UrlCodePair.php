<?php

declare(strict_types=1);

namespace App\UrlConverter\ValueObjects;

class UrlCodePair
{
    public function __construct(
        protected string $code,
        protected string $url,
    ) {
    }

    public function getHash(): string
    {
        return $this->code;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}