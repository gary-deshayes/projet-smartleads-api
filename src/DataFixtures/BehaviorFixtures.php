<?php

namespace App\DataFixtures;
use Faker;
use App\AdminBundle\Entity\Behavior;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BehaviorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $behavior = new Behavior();
            $behavior->setLibelle($faker->word);
            $manager->persist($behavior);
        }
 
        $manager->flush();
    }
}
