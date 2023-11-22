<?php

declare(strict_types=1);

namespace App\UrlConverter\Interfaces;

use InvalidArgumentException;

interface IUrlValidator
{
    /**
     * @param string $url
     * @return bool
     * @throws InvalidArgumentException
     */
    public function validateUrl(string $url): bool;
}