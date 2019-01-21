<?php

namespace App\Repository;

use App\Entity\ParameterGraphicStyles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParameterGraphicStyles|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParameterGraphicStyles|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParameterGraphicStyles[]    findAll()
 * @method ParameterGraphicStyles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParameterGraphicStylesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParameterGraphicStyles::class);
    }

    // /**
    //  * @return ParameterGraphicStyles[] Returns an array of ParameterGraphicStyles objects
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
    public function findOneBySomeField($value): ?ParameterGraphicStyles
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
