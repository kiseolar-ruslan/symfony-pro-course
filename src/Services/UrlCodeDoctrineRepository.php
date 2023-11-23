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
        return (bool)$this->repository->findOneBy([UrlCode::COLUMN_NAME_CODE => $code]);
    }

    public function getUrlByCode(string $code): string
    {
        return $this->getData([UrlCode::COLUMN_NAME_CODE => $code])->getUrl();
    }

    public function getCodeByUrl(string $url): string
    {
        return $this->getData([UrlCode::COLUMN_NAME_URL => $url])->getCode();
    }

    protected function getData(array $criteria): object
    {
        $entity = $this->repository->findOneBy($criteria);

        if (true === is_null($entity)) {
            throw new InvalidArgumentException("Data not found");
        }

        return $entity;
    }
}