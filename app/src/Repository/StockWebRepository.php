<?php

namespace App\Repository;

use App\Entity\StockWeb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockWeb>
 *
 * @method StockWeb|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockWeb|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockWeb[]    findAll()
 * @method StockWeb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockWebRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockWeb::class);
    }

//    /**
//     * @return StockWeb[] Returns an array of StockWeb objects
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

//    public function findOneBySomeField($value): ?StockWeb
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
