<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\UrlCode;
use App\Repository\UrlCodeRepository;
use App\UrlConverter\Interfaces\ICodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use InvalidArgumentException;

class UrlCodeDoctrineRepository implements ICodeRepository
{
    /**
     * @var UrlCodeRepository
     */
    protected ObjectRepository $repository;

    public function __construct(protected EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(UrlCode::class);
    }

    public function codeIsset(string $code): bool
    {
        return (bool)$this->repository->findOneBy(['code' => $code]);
    }

    public function getUrlByCode(string $code): string
    {
        $url = $this->repository->findOneBy(['code' => $code]);

        if (true === is_null($url)) {
            throw new InvalidArgumentException("Url not found by code - $code");
        }

        return $url->getUrl();
    }

    public function getCodeByUrl(string $url): string
    {
        $code = $this->repository->findOneBy(['url' => $url]);

        if (true === is_null($code)) {
            throw new InvalidArgumentException("Code not found by url - $url");
        }

        return $code->getCode();
    }
}