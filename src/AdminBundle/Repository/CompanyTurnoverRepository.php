<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\CompanyTurnover;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyTurnover|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyTurnover|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyTurnover[]    findAll()
 * @method CompanyTurnover[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyTurnoverRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyTurnover::class);
    }

    // /**
    //  * @return CompanyTurnover[] Returns an array of CompanyTurnover objects
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
    public function findOneBySomeField($value): ?CompanyTurnover
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
