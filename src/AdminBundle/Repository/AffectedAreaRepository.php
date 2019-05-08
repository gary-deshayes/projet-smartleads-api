<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\AffectedArea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AffectedArea|null find($id, $lockMode = null, $lockVersion = null)
 * @method AffectedArea|null findOneBy(array $criteria, array $orderBy = null)
 * @method AffectedArea[]    findAll()
 * @method AffectedArea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffectedAreaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AffectedArea::class);
    }

    // /**
    //  * @return AffectedArea[] Returns an array of AffectedArea objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AffectedArea
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
