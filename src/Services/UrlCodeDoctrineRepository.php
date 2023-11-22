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
        return $this->getData('code', $code)->getUrl();
    }

    public function getCodeByUrl(string $url): string
    {
        return $this->getData('url', $url)->getCode();
    }

    protected function getData(string $key, string $value): object
    {
        $entity = $this->repository->findOneBy([$key => $value]);

        if (true === is_null($entity)) {
            throw new InvalidArgumentException("Data not found by - $value");
        }

        return $entity;
    }
}