<?php

namespace App\AdminBundle\Repository;

use App\Entity\ParameterTarget;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParameterTarget|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParameterTarget|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParameterTarget[]    findAll()
 * @method ParameterTarget[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterTargetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParameterTarget::class);
    }

    // /**
    //  * @return ParameterTarget[] Returns an array of ParameterTarget objects
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
    public function findOneBySomeField($value): ?ParameterTarget
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
