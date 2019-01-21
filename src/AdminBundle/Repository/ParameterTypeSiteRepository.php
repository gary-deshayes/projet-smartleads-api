<?php

namespace App\AdminBundle\Repository;

use App\Entity\ParameterTypeSite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParameterTypeSite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParameterTypeSite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParameterTypeSite[]    findAll()
 * @method ParameterTypeSite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterTypeSiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParameterTypeSite::class);
    }

    // /**
    //  * @return ParameterTypeSite[] Returns an array of ParameterTypeSite objects
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
    public function findOneBySomeField($value): ?ParameterTypeSite
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
