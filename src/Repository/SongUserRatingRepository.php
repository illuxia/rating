<?php

namespace App\Repository;

use App\Entity\SongUserRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SongUserRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method SongUserRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method SongUserRating[]    findAll()
 * @method SongUserRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SongUserRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SongUserRating::class);
    }

    // /**
    //  * @return SongUserRating[] Returns an array of SongUserRating objects
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
    public function findOneBySomeField($value): ?SongUserRating
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
