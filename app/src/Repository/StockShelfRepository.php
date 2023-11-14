<?php

namespace App\Repository;

use App\Entity\StockShelf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockShelf>
 *
 * @method StockShelf|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockShelf|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockShelf[]    findAll()
 * @method StockShelf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockShelfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockShelf::class);
    }

//    /**
//     * @return StockShelf[] Returns an array of StockShelf objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StockShelf
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
