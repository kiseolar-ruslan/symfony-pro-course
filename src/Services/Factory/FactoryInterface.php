<?php

declare(strict_types=1);

namespace App\Services\Factory;

interface FactoryInterface
{
    public function create(array $data): object;
}