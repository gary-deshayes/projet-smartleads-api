<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Company;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CompanyFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(1500, "Company", function($count){
            $company = new Company();
            $company->setCode($this->faker->regexify('[A-Z]{10}'));
            $company->setActivityArea($this->getRandomReference("ActivityArea"));
            $company->setIdCompanyCategory($this->getRandomReference("CompanyCategory"));
            $company->setIdSalesperson($this->getRandomReference("Salesperson"));
            $company->setIdLegalStatus($this->getRandomReference("LegalStatus"));
            $company->setNumberEmployees($this->getRandomReference("NumberEmployees"));
            $company->setCompanyStatus($this->getRandomReference("CompanyStatus"));
            $company->setName($this->faker->company);
            $company->setCreatedAt($this->faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now', $timezone = null));
            $company->setUpdatedAt(new \DateTime());
            $company->setComment($this->faker->text($maxNbChars = 50));
            $company->setAddress($this->faker->address);
            $company->setPostalCode($this->faker->randomNumber($nbDigits = 5, $strict = false));
            $company->setTown($this->faker->city);
            $company->setPhone("03" . $this->faker->randomNumber($nbDigits = 8, $strict = false));
            $company->setFax($this->faker->regexify('[0-9]{10}'));
            $company->setActif(true);
            $company->setCreatedAtCompany($this->faker->dateTime($max = 'now', $timezone = null));
            $company->setSiret(str_replace(" ", "", $this->faker->siret));
            $company->setNafCode($this->faker->randomNumber($nbDigits = 4, $strict = false) . $this->faker->randomLetter);

            $company->setTurnovers($this->getRandomReference("Turnovers"));
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
            NumberEmployeesFixtures::class,
            CompanyStatusFixtures::class
        );
    }
}
