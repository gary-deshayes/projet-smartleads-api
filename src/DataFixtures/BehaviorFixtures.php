<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Behavior;
use Doctrine\Common\Persistence\ObjectManager;

class BehaviorFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "Behavior", function($count){
            $behavior = new Behavior();
            $behavior->setLibelle($this->faker->word);
            return $behavior;
        });
 
        $manager->flush();
    }
}
