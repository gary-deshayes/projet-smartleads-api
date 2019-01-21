<?php

namespace App\Repository;

use App\Entity\CompanyCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyCategory[]    findAll()
 * @method CompanyCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyCategory::class);
    }

    // /**
    //  * @return CompanyCategory[] Returns an array of CompanyCategory objects
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
    public function findOneBySomeField($value): ?CompanyCategory
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
