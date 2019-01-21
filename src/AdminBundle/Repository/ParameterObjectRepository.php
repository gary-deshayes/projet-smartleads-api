<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\ParameterObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParameterObject|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParameterObject|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParameterObject[]    findAll()
 * @method ParameterObject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterObjectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParameterObject::class);
    }

    // /**
    //  * @return ParameterObject[] Returns an array of ParameterObject objects
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
    public function findOneBySomeField($value): ?ParameterObject
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
