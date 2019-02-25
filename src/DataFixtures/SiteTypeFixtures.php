<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\SiteType;
use Doctrine\Common\Persistence\ObjectManager;

class SiteTypeFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "SiteType", function($count){
            $siteType = new SiteType();
            $siteType->setLibelle($this->faker->word);
            return $siteType;
        });
        

        $manager->flush();
    }
}
