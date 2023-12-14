<?php

namespace App\Entity;

use App\Interfaces\IncrementalInterface;
use App\Repository\UrlCodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UrlCodeRepository::class)]
class UrlCode implements IncrementalInterface
{
    public const COLUMN_NAME_CODE = 'code';
    public const COLUMN_NAME_URL  = 'url';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'integer', length: 255)]
    protected int $counter = 0;

    public function __construct(
        #[ORM\Column(length: 255)]
        private string $url,
        #[ORM\Column(length: 255)]
        private string $code,
        #[ORM\ManyToOne(targetEntity: User::class, fetch: 'EAGER', inversedBy: 'urls')]
        #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
        protected User $user,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function incrementCounter(): void
    {
        $this->counter++;
    }

    public function getCounter(): int
    {
        return $this->counter;
    }
}
