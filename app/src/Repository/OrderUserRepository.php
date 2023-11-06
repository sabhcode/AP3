<?php

namespace App\Repository;

use App\Entity\OrderUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderUser>
 *
 * @method OrderUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderUser[]    findAll()
 * @method OrderUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderUser::class);
    }

//    /**
//     * @return OrderUser[] Returns an array of OrderUser objects
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

//    public function findOneBySomeField($value): ?OrderUser
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
