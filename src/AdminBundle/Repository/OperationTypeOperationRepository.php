<?php

namespace App\Repository;

use App\Entity\OperationTypeOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OperationTypeOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationTypeOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationTypeOperation[]    findAll()
 * @method OperationTypeOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationTypeOperationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OperationTypeOperation::class);
    }

    // /**
    //  * @return OperationTypeOperation[] Returns an array of OperationTypeOperation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationTypeOperation
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
