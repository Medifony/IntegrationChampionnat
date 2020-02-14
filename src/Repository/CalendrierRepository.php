<?php

namespace App\Repository;

use App\Entity\Calendrier;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Calendrier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calendrier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calendrier[]    findAll()
 * @method Calendrier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendrierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calendrier::class);
    }

    public function findClub($unSlug){
        return $this->createQueryBuilder('c')
                    ->join('c.rencontres', 'r')
                    ->join('r.equipesD', 'eD')
                    ->join('r.equipesE', 'eE')
                    ->select('c')
                    ->where('eD.slug = \'' . $unSlug . '\'')
                    ->orwhere('eE.slug = \'' . $unSlug . '\'')
                    ->getQuery()
                    ->getResult();
    }

    public function findPages(){
        return $this->createQueryBuilder('c')
                    ->select('c')
                    ->groupby('c.journee')
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return Calendrier[] Returns an array of Calendrier objects
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
    public function findOneBySomeField($value): ?Calendrier
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
