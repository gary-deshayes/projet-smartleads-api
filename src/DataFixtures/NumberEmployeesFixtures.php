<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\NumberEmployees;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class NumberEmployeesFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "NumberEmployees", function($count){
            $numberEmployees = new NumberEmployees();
            $numberEmployees->setLibelle($this->faker->randomNumber($nbDigits = NULL, $strict = false));
            return $numberEmployees;
        });

        $manager->flush();
    }
}
