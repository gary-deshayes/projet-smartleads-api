<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Operations;
use Doctrine\Common\Persistence\ObjectManager;

class OperationsFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(2, "Operation", function($count){
            $operation = new Operations();
            $operation->setName($this->faker->word);
            $operation->setUrl($this->faker->url);
            $operation->setTypeOperation($this->faker->randomElement(array('Commerciale', 'Informations', 'Prospection')));
            $operation->setVisualHeadband($this->faker->imageUrl($width = 640, $height = 120));
            $operation->setVisuelLateral($this->faker->imageUrl($width = 120, $height = 680));
            return $operation;
        });

        $manager->flush();
    }
}
