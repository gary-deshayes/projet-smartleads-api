<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\GraphicStyle;
use Doctrine\Common\Persistence\ObjectManager;

class GraphicStyleFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "GraphicStyle", function($count){
            $GraphicStyle = new GraphicStyle();
            $GraphicStyle->setLibelle($this->faker->word);
            return $GraphicStyle;
        });

        $manager->flush();
    }
}
