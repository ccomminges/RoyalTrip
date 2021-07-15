<?php

namespace App\Repository;

use App\Entity\ResetMdp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResetMdp|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResetMdp|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResetMdp[]    findAll()
 * @method ResetMdp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResetMdpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResetMdp::class);
    }

    // /**
    //  * @return ResetMdp[] Returns an array of ResetMdp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResetMdp
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
