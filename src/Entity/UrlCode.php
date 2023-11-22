<?php

namespace App\Entity;

use App\Repository\UrlCodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UrlCodeRepository::class)]
class UrlCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function __construct(
        #[ORM\Column(length: 255)]
        private string $url,
        #[ORM\Column(length: 255)]
        private string $code
    ) {
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
}
