<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\ObjectTable;
use Doctrine\Common\Persistence\ObjectManager;

class ObjectTableFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "ObjectTable", function($count){
            $objectTable = new ObjectTable();
            $objectTable->setLibelle($this->faker->word);
            return $objectTable;
        });

        $manager->flush();
    }
}
