<?php

namespace App\Repository;

use App\Entity\ParamaterGraphicStyles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParamaterGraphicStyles|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParamaterGraphicStyles|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParamaterGraphicStyles[]    findAll()
 * @method ParamaterGraphicStyles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParamaterGraphicStylesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParamaterGraphicStyles::class);
    }

    // /**
    //  * @return ParamaterGraphicStyles[] Returns an array of ParamaterGraphicStyles objects
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
    public function findOneBySomeField($value): ?ParamaterGraphicStyles
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
