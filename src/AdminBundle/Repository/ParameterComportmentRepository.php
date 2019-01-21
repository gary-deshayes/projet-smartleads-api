<?php

namespace App\AdminBundle\Repository;

use App\Entity\ParameterComportment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParameterComportment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParameterComportment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParameterComportment[]    findAll()
 * @method ParameterComportment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterComportmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParameterComportment::class);
    }

    // /**
    //  * @return ParameterComportment[] Returns an array of ParameterComportment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParameterComportment
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
