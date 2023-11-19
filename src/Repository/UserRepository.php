<?php

declare(strict_types=1);

namespace App\Repository;

use App\Traits\BaseRepository;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    use BaseRepository;
}