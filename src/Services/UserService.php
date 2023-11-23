<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    protected UserRepository $repository;

    public function __construct(protected EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(User::class);
    }

    public function createUser(string $login, string $pass, ?int $status = null): User
    {
        //todo create user's factory
        $user = new User($login, $pass, $status ?? User::STATUS_DISABLED);
        $this->em->persist($user);

        return $user;
    }

    public function saveToDB(): void
    {
        $this->em->flush();
    }
}