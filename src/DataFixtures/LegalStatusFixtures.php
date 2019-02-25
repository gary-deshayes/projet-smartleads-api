<?php

namespace App\DataFixtures;

use Faker;
use App\AdminBundle\Entity\LegalStatus;
use Doctrine\Common\Persistence\ObjectManager;

class LegalStatusFixtures extends BaseFixture
{
    // public function load(ObjectManager $manager)
    // {
    //     $faker = Faker\Factory::create('fr_FR');

    //     $LegalStatus1 = new LegalStatus();
    //     $LegalStatus2 = new LegalStatus();
    //     $LegalStatus3 = new LegalStatus();
    //     $LegalStatus4 = new LegalStatus();
    //     $LegalStatus5 = new LegalStatus();
    //     $LegalStatus6 = new LegalStatus();
    //     $LegalStatus7 = new LegalStatus();
    //     $LegalStatus8 = new LegalStatus();

    //     $LegalStatus1->setLibelle("SARL");
    //     $LegalStatus2->setLibelle("SAS");
    //     $LegalStatus3->setLibelle("EURL");
    //     $LegalStatus4->setLibelle("EI");
    //     $LegalStatus5->setLibelle("EIRL");
    //     $LegalStatus6->setLibelle("micro-entrepreneur");
    //     $LegalStatus7->setLibelle("SNC");
    //     $LegalStatus8->setLibelle("SASU");

    //     $manager->persist($LegalStatus1);
    //     $manager->persist($LegalStatus2);
    //     $manager->persist($LegalStatus3);
    //     $manager->persist($LegalStatus4);
    //     $manager->persist($LegalStatus5);
    //     $manager->persist($LegalStatus6);
    //     $manager->persist($LegalStatus7);
    //     $manager->persist($LegalStatus8);

    //     $manager->flush();
    // }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "LegalStatus", function($count){
            $legalStatus = new LegalStatus();
            $legalStatus->setLibelle($this->faker->word);
            return $legalStatus;

        });

        $manager->flush();
    }
}
