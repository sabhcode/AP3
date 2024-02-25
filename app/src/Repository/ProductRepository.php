<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
    * @return Product[] Returns an array of Product objects
    */
    public function findProductsByCategoryAndName($category, $name, $sort = false): array
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.name LIKE :name')
            ->setParameter('name', "%$name%")
        ;

        if($category !== '-1') {
            $query = $query->join('p.category', 'c')
                ->andWhere('c.id = :id')
                ->setParameter('id', $category)
            ;
        }

        $result = $query->getQuery()->getResult();

        if($sort) {

            // Triage
            $searchResult = [];

            foreach($result as $product) {
                $categoryKey = $product->getCategory()?->getId() . ' ' . $product->getCategory()?->getName() . ' ' . $product->getCategory()?->getSlug();
                $searchResult[$categoryKey][] = $product;
            }
            ksort($searchResult);
            $result = $searchResult;

        }

        return $result;
    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


}