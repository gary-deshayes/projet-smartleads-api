<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Turnovers;
use Doctrine\Common\Persistence\ObjectManager;

class TurnoversFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "Turnovers", function($count){
            $turnovers = new Turnovers();
            $turnovers->setLibelle($this->faker->randomNumber($nbDigits = NULL, $strict = false));
            return $turnovers;
        });

        $manager->flush();
    }
}
