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

        if ($search->getSearch()) {
            $query->andWhere('company.name LIKE :search ');

            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }
        return $query->getQuery()->getSingleScalarResult();
    }

    /**
     * Retourne pour chaque jour de la période demandé, la date et le nombre de contacts crée ce jour là
     */
    public function getNumberNewCompanies($since)
    {
        date_default_timezone_set('Europe/Paris');
        $dateNow = date("Y-m-d H:i");
        $dateBefore = date("Y-m-d 00:00", strtotime($since));
        $query = $this->createQueryBuilder("company")
            ->select("COUNT(company.createdAt) as nb, DATE(company.createdAt) as createdAt")
            ->where("DATE(company.createdAt) BETWEEN :date_debut AND :date_fin")
            ->groupby("createdAt")
            ->setParameter('date_debut', $dateBefore)
            ->setParameter('date_fin', $dateNow)
            ->getQuery();
        return $query;
    }

    /**
     * Récupère le nombre de nouvelles entreprises depuis la variable envoyée
     * @param $since Permet de savoir depuis quand on cherche les nouvelles entreprises
     */
    public function getNumberNewCompaniesSince($since)
    {
        date_default_timezone_set('Europe/Paris');
        $dateNow = date("Y-m-d H:i");
        $dateBefore = date("Y-m-d 00:00", strtotime($since));
        dump($dateNow);
        dump($dateBefore);
        $query = $this->createQueryBuilder("company")
            ->select("COUNT(company.createdAt) as nb")
            ->where("DATE(company.createdAt) BETWEEN :date_debut AND :date_fin")
            ->setParameter('date_debut', $dateBefore)
            ->setParameter('date_fin', $dateNow)
            ->getQuery();
        return $query;
    }

    /**
     * Récupère le nombre de nouvelles entreprises depuis la variable envoyée
     * @param $since Permet de savoir depuis quand on cherche les nouvelles entreprises
     */
    public function getNumberCompaniesBetween($begin, $end)
    {
        date_default_timezone_set('Europe/Paris');
        $begin = date("Y-m-d 00:00", strtotime($begin));
        $end = date("Y-m-d 00:00", strtotime($end));
        $query = $this->createQueryBuilder("company")
            ->select("COUNT(company.createdAt) as nb")
            ->where("DATE(company.createdAt) BETWEEN :date_debut AND :date_fin")
            ->setParameter('date_debut', $begin)
            ->setParameter('date_fin', $end)
            ->getQuery();
        return $query->getSingleScalarResult();
    }

    public function getIdCompanyBy($parameter, $value)
    {
        if ($parameter == "company.postalCode") {
            $query = $this->createQueryBuilder("company")
                ->select("company.code")
                ->where($parameter .   " = :value")
                ->setParameter('value', $value)
                ->getQuery();
        } else {
            $query = $this->createQueryBuilder("company")
                ->select("company.code")
                ->where($parameter .   " = :value")
                ->setParameter('value', $value . "%")
                ->getQuery();
        }

        return $query->getResult();
    }
}
