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
}
