<?php

declare(strict_types=1);

namespace App\UrlConverter\Interfaces;

use InvalidArgumentException;

interface ISaveData
{
    /**
     * @param array $data
     * @return void
     * @throws InvalidArgumentException
     */
    public function saveData(array $data): void;
}