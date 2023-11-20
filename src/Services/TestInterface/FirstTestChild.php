<?php

declare(strict_types=1);

namespace App\Services\TestInterface;

use App\Services\TestInterface\TestInterface;

class FirstTestChild implements TestInterface
{

    public function printMessage(): string
    {
        return 'first child';
    }
}