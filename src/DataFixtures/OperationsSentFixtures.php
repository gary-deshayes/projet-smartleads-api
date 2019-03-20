<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\OperationSent;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OperationsSentFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(1, "OperationSent", function($count){
            $operationSent = new OperationSent();
            $operationSent->setIdContacts($this->getRandomReference("Contacts"));
            $operationSent->setIdOperation($this->getRandomReference("Operation"));
            $operationSent->setIdSalesperson($this->getRandomReference("Salesperson"));
            $operationSent->setSentAt(new \DateTime());
            return $operationSent;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ContactsFixtures::class,
            SalespersonFixtures::class,
            OperationsFixtures::class
        );
    }
}
