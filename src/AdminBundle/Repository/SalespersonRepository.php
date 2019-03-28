<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\Salesperson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Salesperson|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salesperson|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salesperson[]    findAll()
 * @method Salesperson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalespersonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Salesperson::class);
    }

    /**
     * @return Salesperson[] Returns an array of Contacts objects
     * @param SalespersonSearch $search Un objet de recherche
     */
    public function getAllSalespersons($search)
    {
        $query = $this->createQueryBuilder('salesperson')
            ->orderBy('salesperson.lastName', 'ASC');

        if ($search->getSearch()) {
            $query->andWhere('salesperson.lastName LIKE :search');
            $query->orWhere('salesperson.firstName LIKE :search');
            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }
      
        return $query->getQuery();
    }

    /**
     * @return Salesperson[] Returns an array of Contacts objects
     */
    public function getCountAllSalespersons($search)
    {
        $query = $this->createQueryBuilder('salesperson')
            ->select('count(salesperson.code)')
            ->orderBy('salesperson.lastName', 'ASC');
            
        if ($search->getSearch()) {
            $query->andWhere('salesperson.lastName LIKE :search');
            $query->orWhere('salesperson.firstName LIKE :search');
            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }
      
        return $query->getQuery()->getSingleScalarResult();
    }

    /**
     * @return Salesperson[] Returns an array of Contacts objects
     * @param SalespersonSearch $search Un objet de recherche
     */
    public function getAllLeader($search)
    {
        $query = $this->createQueryBuilder('salesperson')
            ->andWhere('salesperson.roles LIKE :roles')
            ->orderBy('salesperson.lastName', 'ASC')
            ->setParameter(":roles", '["ROLE_RESPONSABLE"]');

        if($search->getSearch()) {
            $query->andWhere('salesperson.lastName LIKE :search');
            $query->orWhere('salesperson.firstName LIKE :search');

            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }
        
        return $query->getQuery();

    }

    /**
     * @return Salesperson[] Returns an array of Contacts objects
     */
    public function getCountAllLeader()
    {
        $query = $this->createQueryBuilder('salesperson')
            ->select('count(salesperson.code)')
            ->andWhere('salesperson.roles LIKE :roles')
            ->orderBy('salesperson.lastName', 'ASC')
            ->setParameter(":roles", '["ROLE_RESPONSABLE"]')
            ->getQuery();
            
        return $query->getSingleScalarResult();
    }

    /**
     * @return Salesperson[] Returns an array of Contacts objects
     * @param SalespersonSearch $search Un objet de recherche
     */
    public function getAllTeamOneLeader($search, $code)
    {
        $query = $this->createQueryBuilder('salesperson')
            ->andWhere('salesperson.idLeader = :leader')
            ->orderBy('salesperson.lastName', 'ASC')
            ->setParameter(':leader', $code);

        if($search->getSearch()) {
            $query->andWhere('salesperson.lastName LIKE :search OR salesperson.firstName LIKE :search');

            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }
        return $query->getQuery();
    }

    /**
     * @return Salesperson[] Returns an array of Contacts objects
     */
    public function getCountTeamOneLeader($code, $search)
    {
        $query = $this->createQueryBuilder('salesperson')
            ->select('count(salesperson.code)')
            ->andWhere('salesperson.idLeader = :leader')
            ->orderBy('salesperson.lastName', 'ASC')
            ->setParameter(':leader', $code);

            if($search->getSearch()) {
                $query->andWhere('salesperson.lastName LIKE :search OR salesperson.firstName LIKE :search');
    
                $query->setParameter(":search", "%" . $search->getSearch() . "%");
            }
        return $query->getQuery()->getSingleScalarResult();
    }


    /**
     * @return Salesperson[] Returns an array of Contacts objects
     */
    public function getLeader($code)
    {
        $query = $this->createQueryBuilder('salesperson')
            ->andWhere('salesperson.code = :leader')
            ->orderBy('salesperson.lastName', 'ASC')
            ->setParameter(':leader', $code);
        
        return $query->getQuery();

    }
}
