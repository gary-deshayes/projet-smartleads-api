<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\NumberEmployees;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class NumberEmployeesFixtures extends BaseFixture
{
    private $valeurDeBase = [];

    public function __construct(){
        $this->valeurDeBase = [
            0 => "0 à 10",
            1 => "10 à 50",
            2 => "50 à 100",
            3 => "100 à 250",
            4 => "250 à 500",
            5 => "500 à 1000",
            6 => "1000 à 5000",
        ];
    }
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(count($this->valeurDeBase), "NumberEmployees", function($count){
            $numberEmployees = new NumberEmployees();
            $numberEmployees->setLibelle($this->valeurDeBase[$count]);
            return $numberEmployees;
        });

        $manager->flush();
    }
}
