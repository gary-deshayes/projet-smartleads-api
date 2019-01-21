<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\CompanyCountry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyCountry|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyCountry|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyCountry[]    findAll()
 * @method CompanyCountry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyCountryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyCountry::class);
    }

    // /**
    //  * @return CompanyCountry[] Returns an array of CompanyCountry objects
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
    public function findOneBySomeField($value): ?CompanyCountry
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
