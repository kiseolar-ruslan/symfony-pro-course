<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Factory\FactoryInterface;
use App\UrlConverter\Interfaces\ISaveData;
use Doctrine\ORM\EntityManagerInterface;

class UrlCodeDoctrineSaver implements ISaveData
{
    public function __construct(
        protected EntityManagerInterface $em,
        protected FactoryInterface       $factory
    ) {
    }

    public function saveData(array $data): void
    {
        $entity = $this->factory->create($data);

        $this->em->persist($entity);
        $this->em->flush();
    }
}