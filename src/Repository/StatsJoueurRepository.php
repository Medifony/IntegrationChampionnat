<?php

namespace App\Repository;

use App\Entity\Joueur;
use App\Entity\StatsJoueur;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method StatsJoueur|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsJoueur|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsJoueur[]    findAll()
 * @method StatsJoueur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsJoueurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsJoueur::class);
    }

    public function findBestScorers($limit = 5){
        return $this->createQueryBuilder('st')
                    ->join('st.joueurs', 'j')
                    ->select('st as StJouB, SUM(st.buts) as sButs')
                    ->groupBy('j')
                    ->orderBy('sButs', 'DESC')
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }

    public function findBestPassers($limit = 5){
        return $this->createQueryBuilder('st')
                    ->join('st.joueurs', 'j')
                    ->select('st as StJouP, SUM(st.passes) as sPasses')
                    ->groupBy('j')
                    ->orderBy('sPasses', 'DESC')
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }

    public function findSomme($unSlug){
        return $this->createQueryBuilder('st')
                    ->join('st.joueurs', 'j')
                    ->select('SUM(st.min) as sMins, SUM(st.buts) as sButs, SUM(st.passD) as sPassD, SUM(st.tirsC) as sTirsC, SUM(st.tirs) as sTirs,
                    SUM(st.passes) as sPasses, SUM(st.tacles) as sTacles, SUM(st.fautes) as sFautes, SUM(st.cartonsJaunes) as sCartJ, 
                    SUM(st.cartonsRouges) as sCartR')
                    ->where('j.slug = \'' . $unSlug . '\'')
                    ->groupBy('j')
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return StatsJoueur[] Returns an array of StatsJoueur objects
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
    public function findOneBySomeField($value): ?StatsJoueur
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
