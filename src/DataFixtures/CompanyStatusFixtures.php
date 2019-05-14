<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\CompanyStatus;
use Doctrine\Common\Persistence\ObjectManager;

class CompanyStatusFixtures extends BaseFixture
{
    private $valeurDeBase = [];

    public function __construct(){
        $this->valeurDeBase = [
            0 => array("Connaissance", "#66d9ff"),
            1 => array("Prospect", "#ff66ff"),
            2 => array("Client", "#ff4d88"),
            3 => array("Fidèle client", "#ff1a1a"),
        ];
    }
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(count($this->valeurDeBase), "CompanyStatus", function ($count) {
            $companyStatus = new CompanyStatus();
            $companyStatus->setLibelle($this->valeurDeBase[$count][0]);
            $companyStatus->setColor($this->valeurDeBase[$count][1]);

            return $companyStatus;
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
