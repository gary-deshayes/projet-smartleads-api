<?php

namespace App\Repository;

use App\Entity\ContactOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContactOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactOperation[]    findAll()
 * @method ContactOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactOperationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContactOperation::class);
    }

    // /**
    //  * @return ContactOperation[] Returns an array of ContactOperation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContactOperation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
