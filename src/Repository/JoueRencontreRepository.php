<?php

namespace App\Repository;

use App\Entity\JoueRencontre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method JoueRencontre|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoueRencontre|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoueRencontre[]    findAll()
 * @method JoueRencontre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoueRencontreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JoueRencontre::class);
    }

    // /**
    //  * @return JoueRencontre[] Returns an array of JoueRencontre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JoueRencontre
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
