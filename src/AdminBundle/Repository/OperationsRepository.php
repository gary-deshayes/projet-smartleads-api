<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\Operations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Operations::class);
    }

    /**
     * @return Operations[] Returns an array of Contacts objects
     * @param string $search La recheche
     */
    public function getOperations($search)
    {
        $query = $this->createQueryBuilder('operations')
            ->orderBy('operations.name', 'ASC');

        if ($search->getSearch()) {
            $query->andWhere('operations.name LIKE :search');
            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }
      
        return $query->getQuery();
    }

    /**
     * @return int
     */
    public function getCountAllOperations($search)
    {
        $query = $this->createQueryBuilder('operations')
            ->select('count(operations.code)')
            ->orderBy('operations.name', 'ASC');
            
            if($search->getSearch()) {
                $query->andWhere('operations.name LIKE :search ');
    
                $query->setParameter(":search", "%" . $search->getSearch() . "%");
            }
        return $query->getQuery()->getSingleScalarResult();
    }

   
}
