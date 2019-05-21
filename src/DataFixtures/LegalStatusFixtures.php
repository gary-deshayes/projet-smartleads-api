<?php

namespace App\DataFixtures;

use Faker;
use App\AdminBundle\Entity\LegalStatus;
use Doctrine\Common\Persistence\ObjectManager;

class LegalStatusFixtures extends BaseFixture
{
    private $valeurDeBase = [];

    public function __construct(){
        $this->valeurDeBase = [
            0 => "SARL",
            1 => "SAS",
            2 => "EURL",
            3 => "EI",
            4 => "EIRL",
            5 => "micro-entrepreneur",
            6 => "SNC",
            6 => "SASU",
        ];
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(count($this->valeurDeBase), "LegalStatus", function($count){
            $legalStatus = new LegalStatus();
            $legalStatus->setLibelle($this->valeurDeBase[$count]);
            return $legalStatus;

        });

        $manager->flush();
    }
}
