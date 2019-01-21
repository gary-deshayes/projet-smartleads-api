<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\ContactCompanyService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContactCompanyService|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactCompanyService|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactCompanyService[]    findAll()
 * @method ContactCompanyService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactCompanyServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContactCompanyService::class);
    }

    // /**
    //  * @return ContactCompanyService[] Returns an array of ContactCompanyService objects
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
    public function findOneBySomeField($value): ?ContactCompanyService
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
