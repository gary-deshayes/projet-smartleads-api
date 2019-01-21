<?php

namespace App\Repository;

use App\Entity\CompanyNbEmployees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompanyNbEmployees|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyNbEmployees|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyNbEmployees[]    findAll()
 * @method CompanyNbEmployees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyNbEmployeesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompanyNbEmployees::class);
    }

    // /**
    //  * @return CompanyNbEmployees[] Returns an array of CompanyNbEmployees objects
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
    public function findOneBySomeField($value): ?CompanyNbEmployees
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
