<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Settings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SettingsFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $settings = new Settings();
        $settings->setApplicationName("Smartleads");
        $settings->setAddress($this->faker->region);
        $settings->setAdditionalAddress($this->faker->secondaryAddress);
        $settings->setEmail($this->faker->email);
        $settings->setEmailAdmin($this->faker->email);
        $settings->setEmailContact($this->faker->email);
        $manager->persist($settings);
        $manager->flush();
    }
}
