<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Operations;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OperationsFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(2, "Operation", function($count){
            $operation = new Operations();
            $operation->setCode($this->faker->regexify('[A-Z]{10}'));
            $operation->setName($this->faker->word);
            $operation->setAuthor($this->getRandomReference("Salesperson"));
            $operation->setCreated_At(new \DateTime());
            $operation->setUpdatedAt(new \DateTime());
            $operation->setRevival($this->faker->numberBetween($min = 1, $max = 5));
            $operation->setSendingDate($this->faker->dateTimeBetween($startDate = '-1 weeks', $endDate = 'now', $timezone = null));
            $operation->setClosingDate($this->faker->dateTimeBetween($startDate = '-2 weeks', $endDate = '-1 weeks', $timezone = null));
            $operation->setSent(0);
            return $operation;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SalespersonFixtures::class
        ];
    }
}
