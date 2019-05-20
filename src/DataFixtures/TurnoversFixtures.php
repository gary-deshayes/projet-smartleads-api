<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Turnovers;
use Doctrine\Common\Persistence\ObjectManager;

class TurnoversFixtures extends BaseFixture
{

    private $valeurDeBase = [];

    public function __construct(){
        $this->valeurDeBase = [
            0 => "0 à 1 000 euros",
            1 => "1 000 à 2 500 euros",
            2 => "2 500 à 5 000 euros",
            3 => "5 000 à 10 000 euros",
            4 => "10 000 à 25 000 euros",
            5 => "25 000 à 50 000 euros",
            6 => "50 000 à 100 000 euros",
            6 => "100 000 à 250 000 euros",
        ];
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(count($this->valeurDeBase), "Turnovers", function($count){
            $turnovers = new Turnovers();
            $turnovers->setLibelle($this->valeurDeBase[$count]);
            return $turnovers;
        });

        $manager->flush();
    }
}
