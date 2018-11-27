<?php

namespace App\Repository;

use App\Entity\ContactJob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContactJob|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactJob|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactJob[]    findAll()
 * @method ContactJob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactJobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContactJob::class);
    }

    // /**
    //  * @return ContactJob[] Returns an array of ContactJob objects
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
    public function findOneBySomeField($value): ?ContactJob
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
