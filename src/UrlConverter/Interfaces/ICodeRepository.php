<?php

declare(strict_types=1);

namespace App\UrlConverter\Interfaces;

use App\UrlConverter\ValueObjects\UrlCodePair;
use Exception;
use InvalidArgumentException;

interface ICodeRepository
{
    /**
     * @param string $code
     * @return bool
     */
    public function codeIsset(string $code): bool;

    /**
     * @param string $code
     * @return string
     * @throws InvalidArgumentException
     */
    public function getUrlByCode(string $code): string;

    /**
     * @param string $url
     * @return string
     * @throws InvalidArgumentException
     */
    public function getCodeByUrl(string $url): string;
}