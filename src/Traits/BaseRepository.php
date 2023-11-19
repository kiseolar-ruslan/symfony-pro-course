<?php

declare(strict_types=1);

namespace App\Traits;

use Doctrine\ORM\EntityNotFoundException;

trait BaseRepository
{
    /**
     * @throws EntityNotFoundException
     */
    public function getById(int $id): object
    {
        $entity = $this->findOneBy(['id' => $id]);

        if (true === is_null($entity)) {
            throw new EntityNotFoundException("Entity with id - $id is not found!");
        }

        return $entity;
    }

    public function save(?object $entity = null): static
    {
        if (true === is_object($entity)) {
            $this->getEntityManager()->persist($entity);
        }

        $this->getEntityManager()->flush($entity);
        return $this;
    }
}