<?php

namespace App\Repository;

use App\Entity\StockStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockStore>
 *
 * @method StockStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockStore[]    findAll()
 * @method StockStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockStoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockStore::class);
    }

//    /**
//     * @return StockStore[] Returns an array of StockStore objects
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

//    public function findOneBySomeField($value): ?StockStore
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
