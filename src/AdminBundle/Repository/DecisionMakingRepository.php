<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\DecisionMaking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DecisionMaking|null find($id, $lockMode = null, $lockVersion = null)
 * @method DecisionMaking|null findOneBy(array $criteria, array $orderBy = null)
 * @method DecisionMaking[]    findAll()
 * @method DecisionMaking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecisionMakingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DecisionMaking::class);
    }

    // /**
    //  * @return DecisionMaking[] Returns an array of DecisionMaking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DecisionMaking
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
