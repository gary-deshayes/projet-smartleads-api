<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\CompanyLastTurnover;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyLastTurnover|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyLastTurnover|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyLastTurnover[]    findAll()
 * @method CompanyLastTurnover[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyLastTurnoverRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyLastTurnover::class);
    }

    // /**
    //  * @return CompanyLastTurnover[] Returns an array of CompanyLastTurnover objects
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
    public function findOneBySomeField($value): ?CompanyLastTurnover
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
