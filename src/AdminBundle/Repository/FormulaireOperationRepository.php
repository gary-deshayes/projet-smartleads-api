<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\FormulaireOperation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormulaireOperation|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormulaireOperation|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormulaireOperation[]    findAll()
 * @method FormulaireOperation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormulaireOperationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormulaireOperation::class);
    }

    // /**
    //  * @return FormulaireOperation[] Returns an array of FormulaireOperation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormulaireOperation
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
