<?php

namespace App\Repository;

use App\Entity\Way;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Way>
 *
 * @method Way|null find($id, $lockMode = null, $lockVersion = null)
 * @method Way|null findOneBy(array $criteria, array $orderBy = null)
 * @method Way[]    findAll()
 * @method Way[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Way::class);
    }

//    /**
//     * @return Way[] Returns an array of Way objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Way
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
