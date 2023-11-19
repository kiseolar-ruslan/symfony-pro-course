<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
class User
{
    public const STATUS_DISABLED = 0;
    public const STATUS_ACTIVE   = 1;
    public const STATUS_VIP      = 2;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(length: 60)]
    private string $login;

    #[ORM\Column(length: 32)]
    private string $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Phone::class, fetch: 'LAZY')]
    private Collection $phones;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $status;

    public function __construct(string $login, string $password, int $status = self::STATUS_DISABLED)
    {
        $this->login = $login;
        $this->changePassword($password);
        $this->status = $status;
        $this->phones = new ArrayCollection();
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function changeLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function changePassword(string $password): void
    {
        $this->password = md5($password);
    }

    public function isActiveUser(): bool
    {
        return $this->status === static::STATUS_ACTIVE;
    }

    public function isDisabledUser(): bool
    {
        return $this->status === static::STATUS_DISABLED;
    }

    public function isVIPUser(): bool
    {
        return $this->status === static::STATUS_VIP;
    }

    public function setStatusDisabled(): void
    {
        $this->status = static::STATUS_DISABLED;
    }

    public function setStatusActive(): void
    {
        $this->status = static::STATUS_ACTIVE;
    }

    public function setStatusVIP(): void
    {
        $this->status = static::STATUS_VIP;
    }

    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): void
    {
        $this->phones->add($phone);
    }
}