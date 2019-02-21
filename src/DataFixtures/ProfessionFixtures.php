<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Profession;
use Doctrine\Common\Persistence\ObjectManager;

class ProfessionFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "Profession", function ($count) {
            $profession = new Profession();
            $profession->setLibelle($this->faker->word);
            return $profession;
        });
        $manager->flush();
    }
}
