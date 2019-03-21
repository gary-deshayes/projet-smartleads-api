<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\EntitySearch\ContactsSearch;
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
     * @param ContactsSearch $search Un objet de recherche
     */
    public function getContactsCommercial(ContactsSearch $search)
    {
        $query = $this->createQueryBuilder('contacts')
            ->where("contacts.id_salesperson = :salesperson")
            ->orderBy('contacts.lastName', 'ASC')
            ->setParameter(":salesperson", $this->getUser());

        if ($search->getSearch()) {
            $query->andWhere('contacts.lastName LIKE :search');
            $query->orWhere('contacts.firstName LIKE :search');
            $query->setParameter(":search", "%" . $search->getSearch() . "%");
        }

        return $query->getQuery();

    }

    /**
     * @return Contacts[] Returns an array of Contacts objects
     * @param ContactsSearch $search Un objet de recherche
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
}
