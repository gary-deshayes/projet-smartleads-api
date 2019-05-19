<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\OperationSent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class OperationSentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OperationSent::class);
    }
    /**
     * Récupère un contact d'une opération envoyée
     */
    public function getContactOperationSent($uniqid)
    {
        return $this->createQueryBuilder('operationSent')
            ->where("operationSent.uniqIdContact = :uniqIdContact")
            ->setParameter(":uniqIdContact", $uniqid)
            ->getQuery()
            ->getScalarResult();
    }

    /**
     * Récupère les id des contacts qui ont recu une opération
     */
    public function getCodeContactsOperation($operation)
    {
        return $this->createQueryBuilder('operationSent')
            ->select("IDENTITY(operationSent.contacts)")
            ->where("operationSent.operation = :operation")
            ->setParameter(":operation", $operation)
            ->getQuery()->getResult();
    }

    public function getNbNonOuvert($operation)
    {
        return $this->createQueryBuilder('operationSent')
            ->select("COUNT(operationSent.operation) as nombre")
            ->where("operationSent.state = 1")
            ->andWhere("operationSent.operation = :operation")
            ->setParameter(":operation", $operation)
            ->getQuery()
            ->getSingleResult();
    }

    public function getNbLu($operation)
    {
        return $this->createQueryBuilder('operationSent')
            ->select("COUNT(operationSent.operation) as nombre")
            ->where("operationSent.state = 2")
            ->andWhere("operationSent.operation = :operation")
            ->setParameter(":operation", $operation)
            ->getQuery()
            ->getSingleResult();
    }

    public function getNbMAJ($operation)
    {
        return $this->createQueryBuilder('operationSent')
            ->select("COUNT(operationSent.operation) as nombre")
            ->where("operationSent.state = 3")
            ->andWhere("operationSent.operation = :operation")
            ->setParameter(":operation", $operation)
            ->getQuery()
            ->getSingleResult();
    }

    public function getNbContactsOperation($operation)
    {
        return $this->createQueryBuilder('operationSent')
            ->select("COUNT(operationSent.operation) as nombre")
            ->where("operationSent.operation = :operation")
            ->setParameter(":operation", $operation)
            ->getQuery()
            ->getSingleResult();
    }

    public function getByMessageID($messageID)
    {
        return $this->createQueryBuilder('operationSent')
            ->select("count(operationSent.messageID) as nombre")
            ->where("operationSent.messageID = :messageID")
            ->setParameter(":messageID", (int)$messageID)
            ->getQuery()->getSingleResult();
    }

    public function setStateOperationSent($state, $messageID){

        
        return $this->createQueryBuilder("operationSent")
            ->update("\App\AdminBundle\Entity\OperationSent", "o")
            ->set("o.state", ":state")
            ->where("o.messageID = :messageID")
            ->setParameter(":messageID", (int)$messageID)
            ->setParameter(":state", (int)$state)

            ->getQuery()->execute();
    }




    //Fonction pour le dashboard

    public function getPourcentageNewMails($period)
    {

        $actualPeriodNumber = $this->getNumberNewMailsSince($period)->getSingleResult()["nb"];
        dump($actualPeriodNumber);

        $lastPeriodNumber = $this->getNumberMailsBetween($period)->getSingleResult()["nb"];
        dump($lastPeriodNumber);
        if($lastPeriodNumber == 0) {
            $pourcentage = $actualPeriodNumber * 100;
        }else {
            $pourcentage = number_format(($actualPeriodNumber - $lastPeriodNumber) / $lastPeriodNumber * 100, 0, ".", " ");

        }
        return $pourcentage;
    }

    public function getNumberNewMailsSince($since)
    {
        date_default_timezone_set('Europe/Paris');
        $annee = date("Y");
        $query = $this->createQueryBuilder("operation_sent")->select("COUNT(operation_sent.sentAt) as nb");
        switch ($since) {
            case "-1 week":
                $semaine = date("W");
                $query->where("WEEK(operation_sent.sentAt,1) = :week AND YEAR(operation_sent.sentAt) = :year")
                    ->setParameter('week', $semaine)
                    ->setParameter('year', $annee);

                break;
            case "-1 day":
                $query->where("DATE(operation_sent.sentAt) = :date")
                    ->setParameter('date', date("Y-m-d 00:00"));
                break;
            case "-1 month":
                $mois = date("m");
                $query->where("MONTH(operation_sent.sentAt) = :month AND YEAR(operation_sent.sentAt) = :year")
                    ->setParameter('month', $mois)
                    ->setParameter('year', $annee);
                break;
            case "-1 year":
                $query->where("YEAR(operation_sent.sentAt) = :year")
                    ->setParameter('year', $annee);
                break;
        }
        return $query->getQuery();
    }

    /**
     * Récupère le nombre de nouvelles entreprises depuis la variable envoyée
     * @param $since Permet de savoir depuis quand on cherche les nouvelles entreprises
     */
    public function getNumberMailsBetween($since)
    {
        date_default_timezone_set('Europe/Paris');
        $annee = date("Y");
        $query = $this->createQueryBuilder("operation_sent")->select("COUNT(operation_sent.sentAt) as nb");
        switch ($since) {
            case "-1 week":
                $semaine = date("W") - 1;
                $query->where("WEEK(operation_sent.sentAt,1) = :weekBefore")
                ->andWhere("YEAR(operation_sent.sentAt) = :year")
                    ->setParameter('weekBefore', $semaine)

                    ->setParameter('year', $annee);

                break;
            case "-1 day":
                $dateBefore = date("Y-m-d 00:00", strtotime($since));
                $query->where("DATE(operation_sent.sentAt) = :dateBefore")
                    ->setParameter('dateBefore', $dateBefore);
                break;
            case "-1 month":
                $mois = date("m") - 1;
                $query->where("MONTH(operation_sent.sentAt) = :month AND YEAR(operation_sent.sentAt) = :year")
                    ->setParameter('month', $mois)
                    ->setParameter('year', $annee);
                break;
            case "-1 year":
                $query->where("YEAR(operation_sent.sentAt) = :year")
                    ->setParameter('year', $annee - 1);
                break;
        }
        return $query->getQuery();
    }
}
