<?php

namespace App\DataFixtures;


use App\AdminBundle\Entity\Salesperson;
use Doctrine\Common\Persistence\ObjectManager;

class SalespersonFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(5, "Salesperson", function($count){
            $salesperson = new Salesperson();

            $salesperson->setGender($this->faker->randomElement($array = array ('Homme', 'Femme', 'Non précisé')));
            $salesperson->setCode("AZERTYUOO" . $count);
            $salesperson->setFirstName('Baptiste');
            $salesperson->setLastName('ROSSIGNOL');
            $salesperson->setProfile('Commercial');
            $salesperson->setCreatedAt(new \DateTime());
            $salesperson->setUpdatedAt(new \DateTime());
            $salesperson->setEmail($this->faker->email);
            $salesperson->setPassword($this->passwordEncoder->encodePassword(
               $salesperson,
               "azerty"
           ));

           $salesperson->setRoles(["ROLE_ADMIN"]);
        });      

        $manager->flush();
    }
}
