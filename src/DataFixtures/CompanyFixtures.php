<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Company;
use Doctrine\Common\Persistence\ObjectManager;

class CompanyFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        // $this->createMany(10, "Company", function($count){
        //     $company = new Company();
        //     $company->
        // });

        // $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ActivityAreaFixtures::class,
            CompanyCategoryFixtures::class,
            SalespersonFixtures::class,
            LegalStatusFixtures::class,
            NumberEmployeesFixtures::class
        ];
    }
}
