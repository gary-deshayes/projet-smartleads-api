<?php

namespace App\AdminBundle\Repository;

use App\Entity\CompanyActivityArea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyActivityArea|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyActivityArea|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyActivityArea[]    findAll()
 * @method CompanyActivityArea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyActivityAreaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyActivityArea::class);
    }

    // /**
    //  * @return CompanyActivityArea[] Returns an array of CompanyActivityArea objects
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
    public function findOneBySomeField($value): ?CompanyActivityArea
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
