<?php

declare(strict_types=1);

namespace App\Services\Factory;

use App\Entity\User;

interface UrlCodeFactoryInterface
{
    public function create(array $data, User $user): object;
}