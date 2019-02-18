<?php

namespace App\DataFixtures;
use Faker;
use App\AdminBundle\Entity\ActivityArea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ActivityAreaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $activity_area = new ActivityArea();
            $activity_area->setLibelle($faker->word);
            $manager->persist($activity_area);
        }
 
        $manager->flush();
    }
}
