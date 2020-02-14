<?php

namespace App\Repository;

use App\Entity\StatsEquipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StatsEquipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsEquipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsEquipe[]    findAll()
 * @method StatsEquipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsEquipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsEquipe::class);
    }

    // /**
    //  * @return StatsEquipe[] Returns an array of StatsEquipe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatsEquipe
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
