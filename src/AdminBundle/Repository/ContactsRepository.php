<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\EntitySearch\Search;
use App\AdminBundle\Entity\Contacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contacts[]    getAllContacts(ContactsSearch $search)
 * @method Contacts[]    getContactsCommercial(ContactsSearch $search)
 */
class ContactsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contacts::class);
    }

    /**
     * @return Contacts[] Returns an array of Contacts objects
     * @param Search $search Un objet de recherche
     */
    public function getContactsCommercial($search, $id_user)
    {
        $query = $this->createQueryBuilder('contacts')
            ->where("contacts.salesperson = :salesperson")
            ->orderBy('contacts.lastName', 'ASC')
            ->setParameter(":salesperson", $id_user);

        if ($search->getSearch()) {
            $query->andWhere('contacts.lastName LIKE :search');
            $query->orWhere('contacts.firstName LIKE :search');
            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }

        return $query->getQuery();
    }

    /**
     * @return Contacts[] Returns an array of Contacts objects
     */
    public function getCountContactsCommercial($id_user, $search)
    {
        $query = $this->createQueryBuilder('contacts')
            ->select('count(contacts.code)')
            ->where("contacts.salesperson = :salesperson")
            ->orderBy('contacts.lastName', 'ASC')
            ->setParameter(":salesperson", $id_user);
        if ($search->getSearch()) {
            $query->andWhere('contacts.lastName LIKE :search');
            $query->orWhere('contacts.firstName LIKE :search');
            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }

        return $query->getQuery()->getSingleScalarResult();
    }

    /**
     * @return Contacts[] Returns an array of Contacts objects
     * @param Search $search Un objet de recherche
     */
    public function getAllContacts($search)
    {
        $query = $this->createQueryBuilder('contacts')
            ->orderBy('contacts.lastName', 'ASC');

        if ($search->getSearch()) {
            $query->andWhere('contacts.lastName LIKE :search');
            $query->orWhere('contacts.firstName LIKE :search');
            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }
        return $query->getQuery();
    }

    /**
     * @return Contacts[] Returns an array of Contacts objects
     */
    public function getCountAllContacts($search)
    {
        $query = $this->createQueryBuilder('contacts')
            ->select('count(contacts.code)');
        if ($search->getSearch()) {
            $query->andWhere('contacts.lastName LIKE :search');
            $query->orWhere('contacts.firstName LIKE :search');
            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }

        return $query->getQuery()->getSingleScalarResult();
    }

    public function getContactsInArray($array)
    {
        $query = $this->createQueryBuilder('contacts')
            ->orderBy('contacts.lastName', 'ASC')
            ->where("contacts.code in (:array)")
            ->setParameter(":array", $array)
            ->getQuery();
        return $query->getResult();
    }

    public function getContactsOperationNotSend($array)
    {
        $query = $this->createQueryBuilder('contacts')
            ->orderBy('contacts.lastName', 'ASC')
            ->where("contacts.code not in (:array)")
            ->setParameter(":array", $array)
            ->getQuery();
        return $query->getResult();
    }

    public function getContactsWhereCompanyInArray($array)
    {
        $query = $this->createQueryBuilder('contacts')
            ->where("contacts.company in (:array)")
            ->setParameter(":array", $array)
            ->getQuery();
        return $query->getResult();
    }

    public function getContactsWhereSalespersonInArray($array)
    {
        $query = $this->createQueryBuilder('contacts')
            ->where("contacts.salesperson in (:array)")
            ->setParameter(":array", $array)
            ->getQuery();
        return $query->getResult();
    }

    public function getContactsBy($parameter, $value)
    {
        $query = $this->createQueryBuilder("contacts")
            ->select("contacts")
            ->where($parameter . " = :value")
            ->setParameter('value', $value)
            ->getQuery();

        return $query->getResult();
    }

    // Fonction principale au dashboard

    /**
     * Récupère le pourcentage de nouvelles entreprises depuis la dernière période
     */
    public function getPourcentageNewContacts($period)
    {

        $actualPeriodNumber = $this->getNumberNewContactsSince($period)->getSingleResult()["nb"];

        $lastPeriodNumber = $this->getNumberContactsBetween($period)->getSingleResult()["nb"];
        if ($lastPeriodNumber == 0) {
            $pourcentage = $actualPeriodNumber * 100;
        } else {
            $pourcentage = number_format(($actualPeriodNumber - $lastPeriodNumber) / $lastPeriodNumber * 100, 0, ".", " ");
        }
        return $pourcentage;
    }

    /**
     * Retourne pour chaque jour de la période demandé, la date et le nombre de contacts crée ce jour là
     */
    public function getNumberNewContactsPerDay($since)
    {
        date_default_timezone_set('Europe/Paris');
        $dateNow = date("Y-m-d H:i");
        $dateBefore = date("Y-m-d 00:00", strtotime($since));
        $query = $this->createQueryBuilder("contacts")
            ->select("COUNT(contacts.createdAt) as nb, DATE(contacts.createdAt) as createdAt")
            ->where("DATE(contacts.createdAt) BETWEEN :date_debut AND :date_fin")
            ->groupby("createdAt")
            ->setParameter('date_debut', $dateBefore)
            ->setParameter('date_fin', $dateNow)
            ->getQuery();
        return $query;
    }

    /**
     * Retourne pour chaque jour de la période demandé, la date et le nombre de contacts mis à jour ce jour là
     */
    public function getNumberContactsCreatedPerPeriod($since)
    {
        date_default_timezone_set('Europe/Paris');

        $query = $this->createQueryBuilder("contacts");


        switch ($since) {
            case "-1 week":
                $dateNow = date("Y-m-d");
                $dateBefore = date("Y-m-d", strtotime("-1 week"));
                $query->select("COUNT(contacts.createdAt) as nb, DATE(contacts.createdAt) as createdAt")
                    ->where("DATE(contacts.createdAt) BETWEEN :date_debut AND :date_fin")
                    ->groupby("createdAt")
                    ->setParameter('date_debut', $dateBefore)
                    ->setParameter('date_fin', $dateNow)
                    ->getQuery();

                break;
            case "-1 day":
                $query->select("COUNT(contacts.createdAt) as nb, HOUR(contacts.createdAt) as createdAt")
                    ->where("HOUR(contacts.createdAt) BETWEEN '01' AND '24' ")
                    ->andWhere("DATE(contacts.createdAt) = :date")
                    ->groupby("createdAt")
                    ->setParameter('date', date("Y-m-d"))
                    ->getQuery();
                break;
            case "-1 month":
                $query->select("COUNT(contacts.createdAt) as nb, MONTH(contacts.createdAt) as createdAt")
                    ->where("MONTH(contacts.createdAt) BETWEEN '01' AND MONTH(:date_debut) ")
                    ->andWhere("YEAR(contacts.createdAt) = :year")
                    ->groupby("createdAt")
                    ->setParameter('date_debut', date("Y-m-d"))
                    ->setParameter('year', date("Y"))
                    ->getQuery();
                break;
            case "-1 year":
                $query->select("COUNT(contacts.createdAt) as nb, YEAR(contacts.createdAt) as createdAt")
                    ->where("YEAR(contacts.createdAt) BETWEEN :yearLessFive AND :year ")
                    ->groupby("createdAt")
                    ->setParameter('yearLessFive', date("Y") - 5)
                    ->setParameter('year', date("Y"))
                    ->getQuery();
                break;
        }
        return $query->getQuery();
    }

    /**
     * Récupère le nombre de nouveaux contacts depuis la variable envoyée
     * @param $since Permet de savoir depuis quand on cherche les nouveaux contacts
     */
    public function getNumberNewContactsSince($since)
    {
        date_default_timezone_set('Europe/Paris');
        $annee = date("Y");
        $query = $this->createQueryBuilder("contacts")->select("COUNT(contacts.createdAt) as nb");
        switch ($since) {
            case "-1 week":
                $semaine = date("W");
                $query->where("WEEK(contacts.createdAt,1) = :week AND YEAR(contacts.createdAt) = :year")
                    ->setParameter('week', $semaine)
                    ->setParameter('year', $annee);

                break;
            case "-1 day":
                $query->where("DATE(contacts.createdAt) = :date")
                    ->setParameter('date', date("Y-m-d 00:00"));
                break;
            case "-1 month":
                $mois = date("m");
                $query->where("MONTH(contacts.createdAt) = :month AND YEAR(contacts.createdAt) = :year")
                    ->setParameter('month', $mois)
                    ->setParameter('year', $annee);
                break;
            case "-1 year":
                $query->where("YEAR(contacts.createdAt) = :year")
                    ->setParameter('year', $annee);
                break;
        }
        return $query->getQuery();
    }

    /**
     * Récupère le nombre de nouvelles entreprises depuis la variable envoyée
     * @param $since Permet de savoir depuis quand on cherche les nouvelles entreprises
     */
    public function getNumberContactsBetween($since)
    {
        date_default_timezone_set('Europe/Paris');
        $annee = date("Y");
        $query = $this->createQueryBuilder("contacts")->select("COUNT(contacts.createdAt) as nb");
        switch ($since) {
            case "-1 week":
                $semaine = date("W") - 1;
                $query->where("WEEK(contacts.createdAt,1) = :weekBefore")
                    ->andWhere("YEAR(contacts.createdAt) = :year")
                    ->setParameter('weekBefore', $semaine)

                    ->setParameter('year', $annee);

                break;
            case "-1 day":
                $dateBefore = date("Y-m-d 00:00", strtotime($since));
                $query->where("DATE(contacts.createdAt) = :dateBefore")
                    ->setParameter('dateBefore', $dateBefore);
                break;
            case "-1 month":
                $mois = date("m") - 1;
                $query->where("MONTH(contacts.createdAt) = :month AND YEAR(contacts.createdAt) = :year")
                    ->setParameter('month', $mois)
                    ->setParameter('year', $annee);
                break;
            case "-1 year":
                $query->where("YEAR(contacts.createdAt) = :year")
                    ->setParameter('year', $annee - 1);
                break;
        }
        return $query->getQuery();
    }

    /**
     * Retourne pour chaque jour de la période demandé, la date et le nombre de contacts update ce jour là
     */
    public function getNumberUpdatedContactsPerDay($since)
    {
        date_default_timezone_set('Europe/Paris');
        $dateNow = date("Y-m-d H:i");
        $dateBefore = date("Y-m-d 00:00", strtotime($since));
        $query = $this->createQueryBuilder("contacts")
            ->select("COUNT(contacts.updatedAt) as nb, DATE(contacts.updatedAt) as updatedAt")
            ->where("DATE(contacts.updatedAt) BETWEEN :date_debut AND :date_fin")
            ->groupby("updatedAt")
            ->setParameter('date_debut', $dateBefore)
            ->setParameter('date_fin', $dateNow)
            ->getQuery();
        return $query;
    }

    //Permet d'obtenir les données pour le composant d'indice de CRM
    public function getIndiceCRM()
    {
        $totalContacts = count($this->findAll());
        $since3Years = date("Y-m-d", strtotime("-3 years"));
        $since2Years = date("Y-m-d", strtotime("-2 years"));
        $since1Year = date("Y-m-d", strtotime("-1 years"));
        $since6months = date("Y-m-d", strtotime("-6 months"));
        $since3months = date("Y-m-d", strtotime("-3 months"));
        $tabQuery = [];
        //- de 3 ans
        $query = $this->createQueryBuilder("contacts")->select("COUNT(contacts.updatedAt) as nb")
            ->where("contacts.updatedAt BETWEEN :date1 AND :date2")
            ->setParameter("date1", $since3Years)
            ->setParameter("date2", $since2Years)
            ->getQuery()
            ->getSingleResult()["nb"];
        $tabQuery["threeyears"] = $query;
        //- de 2 ans
        $query = $this->createQueryBuilder("contacts")->select("COUNT(contacts.updatedAt) as nb")
            ->where("contacts.updatedAt BETWEEN :date1 AND :date2")
            ->setParameter("date1", $since2Years)
            ->setParameter("date2", $since1Year)
            ->getQuery()->getSingleResult()["nb"];
        $tabQuery["twoyears"] = $query;

        //- d'un an
        $query = $this->createQueryBuilder("contacts")->select("COUNT(contacts.updatedAt) as nb")
            ->where("contacts.updatedAt BETWEEN :date1 AND :date2")
            ->setParameter("date1", $since1Year)
            ->setParameter("date2", $since6months)
            ->getQuery()->getSingleResult()["nb"];
        $tabQuery["oneyear"] = $query;
        // - de 6 mois
        $query = $this->createQueryBuilder("contacts")->select("COUNT(contacts.updatedAt) as nb")
            ->where("contacts.updatedAt BETWEEN :date1 AND :date2")
            ->setParameter("date1", $since6months)
            ->setParameter("date2", $since3months)
            ->getQuery()->getSingleResult()["nb"];
        $tabQuery["sixmonths"] = $query;
        //- de 3 mois
        $query = $this->createQueryBuilder("contacts")->select("COUNT(contacts.updatedAt) as nb")
            ->where("contacts.updatedAt BETWEEN :date1 AND :date2")
            ->setParameter("date1", $since3months)
            ->setParameter("date2", date("Y-m-d"))
            ->getQuery()->getSingleResult()["nb"];
        $tabQuery["threemonths"] = $query;
        $tabQuery["threeYearsPourcent"] = round(($tabQuery["threeyears"] * 100 / $totalContacts), 2);
        $tabQuery["twoYearsPourcent"] = round(($tabQuery["twoyears"] * 100 / $totalContacts), 2);
        $tabQuery["oneYearPourcent"] = round(($tabQuery["oneyear"] * 100 / $totalContacts), 2);
        $tabQuery["sixMonthsPourcent"] = round(($tabQuery["sixmonths"] * 100 / $totalContacts), 2);
        $tabQuery["threeMonthsPourcent"] = round(($tabQuery["threemonths"] * 100 / $totalContacts), 2);
        $tabQuery["pourcentCRM"] = ($tabQuery["threeYearsPourcent"] + $tabQuery["twoYearsPourcent"] + $tabQuery["oneYearPourcent"] + $tabQuery["sixMonthsPourcent"] + $tabQuery["threeMonthsPourcent"]) / 5;
        return $tabQuery;
    }
}
