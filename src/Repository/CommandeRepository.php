<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    public function findCommandesByClient($user)
    {

        return $this->createQueryBuilder('com')
            ->andWhere('com.client = :client')
            ->setParameter('client', $user)
            ->orderBy('com.id', 'DESC')
            ->getQuery()
            ->getResult();


    }

    public function findVoyageByCommande()
    {
        $query=$this
            ->createQueryBuilder('com')  //Produit est représenté par l'alias p par doctrine
            ->select('voy','com')
            ->join('com.voyage','voy');

        return $query->getQuery()->getResult();

    }


    public function deleteCommande($id)
    {

        $this->createQueryBuilder()
            ->delete('commande','com ')
            ->andWhere('com.id=:id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Commande[] Returns an array of Commande objects
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
    public function findOneBySomeField($value): ?Commande
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
