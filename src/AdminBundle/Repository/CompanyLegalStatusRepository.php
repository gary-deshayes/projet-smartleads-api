<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\CompanyLegalStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyLegalStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyLegalStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyLegalStatus[]    findAll()
 * @method CompanyLegalStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyLegalStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyLegalStatus::class);
    }

    // /**
    //  * @return CompanyLegalStatus[] Returns an array of CompanyLegalStatus objects
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
    public function findOneBySomeField($value): ?CompanyLegalStatus
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
