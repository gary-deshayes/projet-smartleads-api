<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Company::class);
    }

    /**
     * @return Company[] Returns an array of Contacts objects
     * @param CompanySearch $search Un objet de recherche
     */
    public function getCompanies($search)
    {
        $query = $this->createQueryBuilder('company')
            ->orderBy('company.name', 'ASC');

        if ($search->getSearch()) {
            $query->andWhere('company.name LIKE :search');
            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }
      
        return $query->getQuery();
    }

    /**
     * @return Company[] Returns an array of Contacts objects
     */
    public function getCountAllCompanies($search)
    {
        $query = $this->createQueryBuilder('company')
            ->select('count(company.code)')
            ->orderBy('company.name', 'ASC');
            
            if($search->getSearch()) {
                $query->andWhere('company.name LIKE :search ');
    
                $query->setParameter(":search", "%" . $search->getSearch() . "%");
            }
        return $query->getQuery()->getSingleScalarResult();
    }

   
}
