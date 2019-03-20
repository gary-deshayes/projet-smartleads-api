<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Profession;
use Doctrine\Common\Persistence\ObjectManager;

class ProfessionFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(30, "Profession", function ($count) {
            $profession = new Profession();
            $profession->setLibelle($this->faker->jobTitle);
            return $profession;
        });
        $manager->flush();
    }
}
