<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Phone;
use App\Traits\BaseRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

class PhoneRepository extends EntityRepository
{
    use BaseRepository;

    /**
     * @throws EntityNotFoundException
     */
    public function getByNumber(string $phone): Phone
    {
        $phone = $this->findOneBy(['phone' => $phone]);

        if (true === is_null($phone)) {
            throw new EntityNotFoundException("Entity with phone - $phone is not found!");
        }

        return $phone;
    }
}