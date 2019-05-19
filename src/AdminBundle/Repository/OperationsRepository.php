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

        if ($search->getSearch()) {
            $query->andWhere('operations.name LIKE :search ');

            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }
        return $query->getQuery()->getSingleScalarResult();
    }

    public function getContactOperationSent($uniqid)
    {
        return $this->createQueryBuilder('operationSent')
            ->select("operationSent.contacts")
            ->where("operationSent.uniqIdContact = :uniqIdContact")
            ->setParameter(":uniqIdContact", $uniqid)
            ->getQuery()
            ->getResult();
    }

    /**
     * Retourne le nombre d'opérations actives pendant une période
     */
    public function getNbOperationsActives($between){
        date_default_timezone_set('Europe/Paris');
        $target_date = date("Y-m-d 00:00", strtotime($between));
        $query = $this->createQueryBuilder("operation")
            ->select("COUNT(operation.closing_date) as nb")
            ->where("DATE(operation.closing_date) BETWEEN :target_date AND :now")
            ->setParameter('target_date', $target_date )
            ->setParameter('now', date("Y-m-d H:i"))
            ->getQuery();
        return $query->getResult();
    }

    /**
     * Retourne le nombre de nouvelles opérations pour chaque jour de la période
     */
    public function getNumberOperationsPerDay($since){
        date_default_timezone_set('Europe/Paris');
        $dateNow = date("Y-m-d H:i");
        $dateBefore = date("Y-m-d 00:00", strtotime($since));
        $query = $this->createQueryBuilder("operations")
            ->select("COUNT(operations.created_at) as nb, DATE(operations.created_at) as created_at")
            ->where("DATE(operations.created_at) BETWEEN :date_debut AND :date_fin")
            ->groupby("created_at")
            ->setParameter('date_debut', $dateBefore)
            ->setParameter('date_fin', $dateNow)
            ->getQuery();
        return $query;
    }



    //Function dashbord 
    
    public function getPourcentageOperationsActive($period)
    {

        $actualPeriodNumber = $this->getNumberActivesOperationsSince($period)->getSingleResult()["nb"];
        dump($actualPeriodNumber);

        $lastPeriodNumber = $this->getNumberOperationsActiveBetween($period)->getSingleResult()["nb"];
        dump($lastPeriodNumber);
        if($lastPeriodNumber == 0) {
            $pourcentage = $actualPeriodNumber * 100;
        }else {
            $pourcentage = number_format(($actualPeriodNumber - $lastPeriodNumber) / $lastPeriodNumber * 100, 0, ".", " ");

        }
        return $pourcentage;
    }

    public function getNumberActivesOperationsSince($since)
    {
        date_default_timezone_set('Europe/Paris');
        $annee = date("Y");
        $query = $this->createQueryBuilder("operation")->select("COUNT(operation.closing_date) as nb");
        switch ($since) {
            case "-1 week":
                $semaine = date("W");
                $query->where("WEEK(operation.closing_date, 1) <= :lastWeek AND WEEK(operation.closing_date, 1) >= :week ")
                    ->andWhere("YEAR(operation.closing_date) = :year")
                    ->setParameter('week', $semaine)
                    ->setParameter('lastWeek', $semaine - 1)

                    ->setParameter('year', $annee);

                break;
            case "-1 day":
                $query->where("DATE(operation.closing_date) >= :date")
                    ->setParameter('date', date("Y-m-d 00:00"));
                break;
            case "-1 month":
                $mois = date("m");
                $query->where("MONTH(operation.closing_date) = :month AND YEAR(operation.closing_date) = :year")
                    ->setParameter('month', $mois)
                    ->setParameter('year', $annee);
                break;
            case "-1 year":
                $query->where("YEAR(operation.closing_date) = :year")
                    ->setParameter('year', $annee);
                break;
        }
        return $query->getQuery();
    }

    /**
     * Récupère le nombre de nouvelles entreprises depuis la variable envoyée
     * @param $since Permet de savoir depuis quand on cherche les nouvelles entreprises
     */
    public function getNumberOperationsActiveBetween($since)
    {
        date_default_timezone_set('Europe/Paris');
        $annee = date("Y");
        $query = $this->createQueryBuilder("operation")->select("COUNT(operation.closing_date) as nb");
        switch ($since) {
            case "-1 week":
                $semaine = date("W") - 1;
                $query->where("WEEK(operation.closing_date,1) = :weekBefore")
                ->andWhere("YEAR(operation.closing_date) = :year")
                    ->setParameter('weekBefore', $semaine)

                    ->setParameter('year', $annee);

                break;
            case "-1 day":
                $dateBefore = date("Y-m-d 00:00", strtotime($since));
                $query->where("DATE(operation.closing_date) = :dateBefore")
                    ->setParameter('dateBefore', $dateBefore);
                break;
            case "-1 month":
                $mois = date("m") - 1;
                $query->where("MONTH(operation.closing_date) = :month AND YEAR(operation.closing_date) = :year")
                    ->setParameter('month', $mois)
                    ->setParameter('year', $annee);
                break;
            case "-1 year":
                $query->where("YEAR(operation.closing_date) = :year")
                    ->setParameter('year', $annee - 1);
                break;
        }
        return $query->getQuery();
    }

}
