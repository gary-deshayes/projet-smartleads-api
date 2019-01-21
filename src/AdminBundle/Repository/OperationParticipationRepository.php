<?php

namespace App\AdminBundle\Repository;

use App\Entity\OperationParticipation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OperationParticipation|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationParticipation|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationParticipation[]    findAll()
 * @method OperationParticipation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationParticipationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OperationParticipation::class);
    }

    // /**
    //  * @return OperationParticipation[] Returns an array of OperationParticipation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationParticipation
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
