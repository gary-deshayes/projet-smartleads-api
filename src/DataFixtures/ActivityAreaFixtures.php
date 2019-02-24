<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\ActivityArea;
use Doctrine\Common\Persistence\ObjectManager;

class ActivityAreaFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "ActivityArea", function ($count) {
            $activityArea = new ActivityArea();
            $activityArea->setLibelle($this->faker->word);
            return $activityArea;
        });



        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CompanyCategoryFixtures::class
        );
    }
}
