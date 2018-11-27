<?php

namespace App\Repository;

use App\Entity\CompanyStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyStatus[]    findAll()
 * @method CompanyStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyStatus::class);
    }

    // /**
    //  * @return CompanyStatus[] Returns an array of CompanyStatus objects
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
    public function findOneBySomeField($value): ?CompanyStatus
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
