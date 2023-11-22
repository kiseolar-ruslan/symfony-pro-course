<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\UrlCode;
use App\UrlConverter\Interfaces\ISaveData;
use Doctrine\ORM\EntityManagerInterface;

class UrlCodeDoctrineSaver implements ISaveData
{
    public function __construct(protected EntityManagerInterface $em)
    {
    }

    public function saveData(array $data): void
    {
        $code = array_key_first($data);
        $url  = current($data);

        $entity = new UrlCode($url, $code);
        $this->em->persist($entity);
        $this->em->flush();
    }
}