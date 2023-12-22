<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\User;
use App\Services\Factory\UrlCodeFactory;
use App\UrlConverter\Interfaces\ISaveData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class UrlCodeDoctrineSaver implements ISaveData
{
    public function __construct(
        protected EntityManagerInterface $em,
        protected UrlCodeFactory         $factory,
        protected Security               $security
    ) {
    }

    public function saveData(array $data): void
    {
        /**
         * @var User $user
         */
        $user = $this->security->getUser();

        $entity = $this->factory->create($data, $user);

        $this->em->persist($entity);
        $this->em->flush();
    }
}