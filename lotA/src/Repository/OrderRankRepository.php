<?php

namespace App\Repository;

use App\Entity\OrderRank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderRank>
 *
 * @method OrderRank|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRank|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRank[]    findAll()
 * @method OrderRank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRankRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderRank::class);
    }

//    /**
//     * @return OrderRank[] Returns an array of OrderRank objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrderRank
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
