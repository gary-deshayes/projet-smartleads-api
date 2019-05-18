<?php

namespace App\AdminBundle\Repository;

use Doctrine\ORM\Query;
use App\AdminBundle\Entity\Company;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
        $annee = date("Y");
        $query = $this->createQueryBuilder("company")->select("COUNT(company.createdAt) as nb");
        switch ($since) {
            case "-1 week":
                $semaine = date("W");
                $query->where("WEEK(company.createdAt,1) = :week AND YEAR(company.createdAt) = :year")
                    ->setParameter('week', $semaine)
                    ->setParameter('year', $annee);

                break;
            case "-1 day":
                $query->where("DATE(company.createdAt) = :date")
                    ->setParameter('date', date("Y-m-d 00:00"));
                break;
            case "-1 month":
                $mois = date("m");
                $query->where("MONTH(company.createdAt) = :month AND YEAR(company.createdAt) = :year")
                    ->setParameter('month', $mois)
                    ->setParameter('year', $annee);
                break;
            case "-1 year":
                $query->where("YEAR(company.createdAt) = :year")
                    ->setParameter('year', $annee);
                break;
        }
        return $query->getQuery();
    }

    /**
     * Récupère le nombre de nouvelles entreprises depuis la variable envoyée
     * @param $since Permet de savoir depuis quand on cherche les nouvelles entreprises
     */
    public function getNumberCompaniesBetween($since)
    {
        date_default_timezone_set('Europe/Paris');
        $annee = date("Y");
        $query = $this->createQueryBuilder("company")->select("COUNT(company.createdAt) as nb");
        switch ($since) {
            case "-1 week":
                $semaine = date("W") - 1;
                $query->where("WEEK(company.createdAt,1) = :weekBefore")
                ->andWhere("YEAR(company.createdAt) = :year")
                    ->setParameter('weekBefore', $semaine)

                    ->setParameter('year', $annee);

                break;
            case "-1 day":
                $dateBefore = date("Y-m-d 00:00", strtotime($since));
                $query->where("DATE(company.createdAt) = :dateBefore")
                    ->setParameter('dateBefore', $dateBefore);
                break;
            case "-1 month":
                $mois = date("m") - 1;
                $query->where("MONTH(company.createdAt) = :month AND YEAR(company.createdAt) = :year")
                    ->setParameter('month', $mois)
                    ->setParameter('year', $annee);
                break;
            case "-1 year":
                $query->where("YEAR(company.createdAt) = :year")
                    ->setParameter('year', $annee - 1);
                break;
        }
        return $query->getQuery();
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

    /**
     * Récupère le pourcentage de nouvelles entreprises depuis la dernière période
     */
    public function getPourcentageNewCompanies($period)
    {

        $actualPeriodNumber = $this->getNumberNewCompaniesSince($period)->getSingleResult()["nb"];
        $lastPeriodNumber = $this->getNumberCompaniesBetween($period)->getSingleResult()["nb"];
        $pourcentage = number_format(($actualPeriodNumber - $lastPeriodNumber) / $lastPeriodNumber * 100, 0, ".", " ");
        return $pourcentage;
    }
}
