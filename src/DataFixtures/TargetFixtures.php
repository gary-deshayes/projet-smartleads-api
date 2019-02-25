<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Target;
use Doctrine\Common\Persistence\ObjectManager;

class TargetFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "Target", function($count){
            $target = new Target();
            $target->setLibelle($this->faker->word);
            return $target;
        });

        $manager->flush();
    }
}
