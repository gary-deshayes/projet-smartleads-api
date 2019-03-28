<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Region;
use Doctrine\Common\Persistence\ObjectManager;

class RegionFixtures extends BaseFixture
{
    /**
     * Var Array
     */
    private $t_regions;

    /**
     * Var Array
     */
    private $keys;

    /**
     * Var Array
     */
    private $values;

    public function __construct(){
        $this->t_regions = array(); 
        $this->t_regions['Alsace'] = '67,68'; 
        $this->t_regions['Aquitaine'] = '24,33,40,47,64'; 
        $this->t_regions['Auvergne'] = '03,15,43,63'; 
        $this->t_regions['Basse-Normandie'] = '14,50,61'; 
        $this->t_regions['Bourgogne'] = '21,58,71,89'; 
        $this->t_regions['Bretagne'] = '22,29,35,56'; 
        $this->t_regions['Centre'] = '18,28,36,37,41,45'; 
        $this->t_regions['Champagne-Ardenne'] = '08,10,51,52'; 
        $this->t_regions['Corse'] = '2A,2B'; 
        $this->t_regions['Franche-Comté'] = '25,39,70,90'; 
        $this->t_regions['Haute-Normandie'] = '27,76'; 
        $this->t_regions['Ile-de-France'] = '75,77,78,91,92,93,94,95'; 
        $this->t_regions['Languedoc-Roussillon'] = '11,30,34,48,66'; 
        $this->t_regions['Limousin'] = '19,23,87'; 
        $this->t_regions['Lorraine'] = '54,55,57,88'; 
        $this->t_regions['Midi-Pyrénées'] = '09,12,31,32,46,65,81,82'; 
        $this->t_regions['Nord-Pas-de-Calais'] = '59,62'; 
        $this->t_regions['Pays de la Loire'] = '44,49,53,72,85'; 
        $this->t_regions['Picardie'] = '02,60,80'; 
        $this->t_regions['Poitou-Charentes'] = '16,17,79,86'; 
        $this->t_regions['Provence-Alpes-Côte-d\'Azur'] = '04,05,06,13,83,84'; 
        $this->t_regions['Rhône-Alpes'] = '01,07,26,38,42,69,73,74'; 
        $this->t_regions['DOM'] = '971,972,973,974'; 
        dump($this->t_regions);
        $this->keys = array_keys($this->t_regions);
        $this->values = array_values($this->t_regions);
    }
    public function loadData(ObjectManager $manager)
    {
        
        $this->createMany(count($this->t_regions), "Region", function ($count) {
            $region = new Region();
            $region->setCodes($this->values[$count]);
            $region->setLibelle($this->keys[$count]);
            return $region;
        });

        $manager->flush();
    }
}
