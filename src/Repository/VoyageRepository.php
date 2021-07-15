<?php

namespace App\Repository;

use App\Classe\CritereRecherche;
use App\Entity\Voyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Voyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voyage[]    findAll()
 * @method Voyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voyage::class);
    }


/**
* Requete pour afficher les voyages slon le critere de rechrche :
*  @return Voyage[]
*/
    public function findWithSearch(CritereRecherche $search)
    {

       /* $query = $this->getEntityManager()
            ->createQuery("
                SELECT voy FROM Voyage voy
                WHERE voy.nom LIKE :key or voy.tarif=:key2 "
            );
        $query->setParameter('key', "%$search->string%")
            ->setParameter('key2', "%$search->integer%");

        return $query->getQuery()->getResult();*/

        $query= $this
                ->createQueryBuilder('voy')
        ->select('dest','voy')
        ->join('voy.destination','dest');


        if(!empty($search->string))
        {
            $query = $query
                ->andWhere('voy.nom  LIKE :string ')
                //->andWhere('voy.tarif=:string2 ')
                ->setParameter('string', "%$search->string%");
                //->setParameter('string2', $search->integer);

        }

        if( !empty($search->destinations))
        {
            $query=$query
                ->andWhere('dest.id IN (:destination)')
                ->setParameter('destination',$search->destinations);
        }

        return $query->getQuery()->getResult();


    }


    // /**
    //  * @return Voyage[] Returns an array of Voyage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Voyage
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
