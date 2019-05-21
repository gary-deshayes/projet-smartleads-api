<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\ActivityArea;
use Doctrine\Common\Persistence\ObjectManager;

class ActivityAreaFixtures extends BaseFixture
{


    private $csvNaf = [];

    public function __construct(){
        if (($handle = fopen("src/DataFixtures/CSV/naf.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                $i = 0;
                $donnee = "";
                for ($c=0; $c < $num; $c++) {
                    if($i == 0){
                        $donnee .= $data[$c] . " - ";
                    } else if($i == 1) {
                        $donnee .= $data[$c];
                    }
                    $i++;
                }
                if($donnee == "Code NAF - Intitule NAF"){

                }else {
                    array_push($this->csvNaf, $donnee);
                }
                
            }
            fclose($handle);
        }
    }
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(count($this->csvNaf), "ActivityArea", function ($count) {
            $activityArea = new ActivityArea();
            $activityArea->setLibelle($this->csvNaf[$count]);
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
