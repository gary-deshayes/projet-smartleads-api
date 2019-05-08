<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\Department;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Department|null find($id, $lockMode = null, $lockVersion = null)
 * @method Department|null findOneBy(array $criteria, array $orderBy = null)
 * @method Department[]    findAll()
 * @method Department[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Department::class);
    }

    /**Retourne les départements d'une zone */
    public function getDepartmentAffectedArea($affectedArea){
        $query = $this->createQueryBuilder('department')
            ->orderBy('department.libelle', 'ASC')
            ->where("department.affectedArea = :id_area")
            ->setParameter(":id_area", $affectedArea);

      
        return $query->getQuery();
    }

    /**
     * Retourne les départements dans une zone
     */
    public function getDepartmentWithAffectedArea(){
        $query = $this->createQueryBuilder('department')
            ->orderBy('department.libelle', 'ASC')
            ->where("department.affectedArea IS NOT NULL");

      
        return $query->getQuery();
    }

    /**
     * Retourne les départements dont l'id est dans le tableau en paramètre
     */
    public function getDepartmentInArray($ids){
        $query = $this->createQueryBuilder('department')
            ->where("department.id in (:ids)")
            ->setParameter(":ids", $ids);

      
        return $query->getQuery();
    }
}
