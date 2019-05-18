<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\EntitySearch\Search;
use App\AdminBundle\Entity\Contacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Proxies\__CG__\App\AdminBundle\Entity\Salesperson;

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
    public function getCountContactsCommercial($id_user)
    {
        $query = $this->createQueryBuilder('contacts')
            ->select('count(contacts.code)')
            ->where("contacts.salesperson = :salesperson")
            ->orderBy('contacts.lastName', 'ASC')
            ->setParameter(":salesperson", $id_user)
            ->getQuery();

        return $query->getSingleScalarResult();
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
    public function getCountAllContacts()
    {
        $query = $this->createQueryBuilder('contacts')
            ->select('count(contacts.code)')
            ->getQuery();

        return $query->getSingleScalarResult();
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
            ->where($parameter .   " = :value")
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
        dump($actualPeriodNumber);

        $lastPeriodNumber = $this->getNumberContactsBetween($period)->getSingleResult()["nb"];
        dump($lastPeriodNumber);
        $pourcentage = number_format(($actualPeriodNumber - $lastPeriodNumber) / $lastPeriodNumber * 100, 0, ".", " ");
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
    public function getNumberContactsUpdatedPerDay($since)
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
}
