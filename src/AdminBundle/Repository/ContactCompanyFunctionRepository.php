<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\ContactCompanyFunction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContactCompanyFunction|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactCompanyFunction|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactCompanyFunction[]    findAll()
 * @method ContactCompanyFunction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactCompanyFunctionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContactCompanyFunction::class);
    }

    // /**
    //  * @return ContactCompanyFunction[] Returns an array of ContactCompanyFunction objects
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
    public function findOneBySomeField($value): ?ContactCompanyFunction
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
