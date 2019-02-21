<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\CompanyCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CompanyCategoryFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, "CompanyCategory", function($count){
            $companyCategory = new CompanyCategory();
            $companyCategory->setLibelle($this->faker->word);
            return $companyCategory;
        });
 
        $manager->flush();
    }
}
