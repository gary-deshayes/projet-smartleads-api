<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\SettingsOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SettingsOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SettingsOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SettingsOperation[]    findAll()
 * @method SettingsOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SettingsOperationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SettingsOperation::class);
    }

    // /**
    //  * @return SettingsOperation[] Returns an array of SettingsOperation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SettingsOperation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
