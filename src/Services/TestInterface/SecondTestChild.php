<?php

declare(strict_types=1);

namespace App\Services\TestInterface;

use App\Services\TestInterface\TestInterface;

class SecondTestChild implements TestInterface
{

    public function printMessage(): string
    {
        return 'second child';
    }
}