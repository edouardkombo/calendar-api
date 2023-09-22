<?php

namespace App\Repository;

use App\Entity\Reccurency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reccurency>
 *
 * @method Reccurency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reccurency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reccurency[]    findAll()
 * @method Reccurency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReccurencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reccurency::class);
    }

//    /**
//     * @return Reccurency[] Returns an array of Reccurency objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reccurency
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
