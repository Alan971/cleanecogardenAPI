<?php

namespace App\Repository;

use App\Entity\Advice;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Advice>
 */
class AdviceRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advice::class);
    }

    public function findAllBSortedByMonth(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.month', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
       /**
        * @return Advice[] Returns an array of Advice objects
        */
       public function findAllInMonth($month): array
       {
           return $this->createQueryBuilder('a')
               ->andWhere('a.month = :val')
               ->setParameter('val', $month)
               ->orderBy('a.id', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }
       public function delete($id)
       {
           $this->createQueryBuilder('a')
               ->delete()
               ->where('a.id = :val')
               ->setParameter('val', $id)
               ->getQuery()
               ->execute()
           ;
       }


    //    /**
    //     * @return Advice[] Returns an array of Advice objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Advice
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
