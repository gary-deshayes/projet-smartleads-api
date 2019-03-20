<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Company;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CompanyFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(100, "Company", function($count){
            $company = new Company();
            $company->setCode($this->faker->regexify('[A-Z]{10}'));
            $company->setIdActivityArea($this->getRandomReference("ActivityArea"));
            $company->setIdCompanyCategory($this->getRandomReference("CompanyCategory"));
            $company->setIdSalesperson($this->getRandomReference("Salesperson"));
            $company->setIdLegalStatus($this->getRandomReference("LegalStatus"));
            $company->setIdNumberEmployees($this->getRandomReference("NumberEmployees"));
            $company->setName($this->faker->name);
            $company->setCreatedAt(new \DateTime());
            $company->setUpdatedAt(new \DateTime());
            $company->setStatus($this->faker->boolean());
            $company->setComment($this->faker->text($maxNbChars = 50));
            $company->setCountry($this->faker->country);
            $company->setAddress($this->faker->address);
            $company->setAdditionalAddress($this->faker->secondaryAddress);
            $company->setPostalCode($this->faker->randomNumber($nbDigits = 5, $strict = false));
            $company->setTown($this->faker->city);
            $company->setPhone("03" . $this->faker->randomNumber($nbDigits = 8, $strict = false));
            $company->setFax($this->faker->regexify('[0-9]{10}'));
            $company->setWebsite($this->faker->url);
            $company->setCreatedAtCompany($this->faker->dateTime($max = 'now', $timezone = null));
            $company->setSiret(str_replace(" ", "", $this->faker->siret));
            $company->setNafCode($this->faker->randomNumber($nbDigits = 4, $strict = false) . $this->faker->randomLetter);

            $company->addIdTurnover($this->getRandomReference("Turnovers"));
            return $company;
        });

        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            CompanyCategoryFixtures::class,
            ActivityAreaFixtures::class,
            SalespersonFixtures::class,
            LegalStatusFixtures::class,
            NumberEmployeesFixtures::class
        );
    }
}
