<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Zipcode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Zipcode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zipcode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zipcode[]    findAll()
 * @method Zipcode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZipcodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Zipcode::class);
    }
}
