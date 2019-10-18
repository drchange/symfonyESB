<?php

namespace App\Repository;

use App\Entity\CurlConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CurlConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method CurlConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method CurlConfig[]    findAll()
 * @method CurlConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurlConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CurlConfig::class);
    }

    // /**
    //  * @return CurlConfig[] Returns an array of CurlConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CurlConfig
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
