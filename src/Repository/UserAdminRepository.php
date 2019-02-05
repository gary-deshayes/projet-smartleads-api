<?php

namespace App\Repository;

use App\Entity\UserAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserAdmin|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAdmin|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAdmin[]    findAll()
 * @method UserAdmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAdminRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserAdmin::class);
    }

    // /**
    //  * @return UserAdmin[] Returns an array of UserAdmin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserAdmin
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
