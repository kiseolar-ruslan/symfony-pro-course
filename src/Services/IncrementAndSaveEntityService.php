<?php

namespace App\Services;

use App\Interfaces\IncrementalInterface;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

class IncrementAndSaveEntityService
{
    public function __construct(protected EntityManagerInterface $em)
    {
    }

    public function increment(IncrementalInterface $obj): void
    {
        $obj->incrementCounter();

        try {
            $this->em->persist($obj);
            $this->em->flush();
        } catch (Throwable) {
        }
    }
}