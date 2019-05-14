<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\DecisionMaking;
use Doctrine\Common\Persistence\ObjectManager;

class DecisionMakingFixtures extends BaseFixture
{
    private $valeurDeBase = [];

    public function __construct(){
        $this->valeurDeBase = [
            0 => "Chef",
            1 => "Expert",
            2 => "Jeune salarié",
        ];
    }
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(count($this->valeurDeBase), "DecisionMaking", function ($count) {
            $decisionMaking = new DecisionMaking();
            $decisionMaking->setLibelle($this->valeurDeBase[$count]);
            return $decisionMaking;
        });

        $manager->flush();
    }
}
