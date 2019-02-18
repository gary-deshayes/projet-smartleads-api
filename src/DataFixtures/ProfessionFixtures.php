<?php

namespace App\DataFixtures;

use Faker;
use App\AdminBundle\Entity\Profession;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProfessionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $Profession = new Profession();
            $Profession->setLibelle($faker->word);
            $manager->persist($Profession);
        }
 
        $manager->flush();
    }
}
