<?php

namespace App\Repository;

use App\Entity\UrlCode;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<UrlCode>
 *
 * @method UrlCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method UrlCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method UrlCode[]    findAll()
 * @method UrlCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlCodeRepository extends EntityRepository
{

}
