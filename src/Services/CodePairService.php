<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\UrlCode;
use App\Entity\User;
use App\Repository\UrlCodeRepository;
use Doctrine\ORM\EntityManagerInterface;

class CodePairService
{
    protected UrlCodeRepository $repository;

    public function __construct(protected EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(UrlCode::class);
    }

    public function getAllObjects(User $user)
    {
        return $this->repository->findAll();
    }
}