<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Contacts;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ContactsFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(100, "Contacts", function ($count) {
            $contacts = new Contacts();
            $contacts->setCode($this->faker->regexify('[A-Z]{10}'));
            $contacts->setProfession($this->getRandomReference("Profession"));
            $contacts->setGender($this->faker->randomElement($array = array('Homme', 'Femme', 'Non précisé')));
            $contacts->setLastName($this->faker->lastName);
            $contacts->setFirstName($this->faker->firstName('male'|'female'));
            $contacts->setCreatedAt($this->faker->dateTimeBetween($startDate = '-2 weeks', $endDate = 'now', $timezone = null));
            $contacts->setUpdatedAt(new \DateTime());
            $contacts->setStatus($this->faker->boolean());
            $contacts->setBirthDate($this->faker->dateTime($max = 'now', $timezone = null));
            $contacts->setMobilePhone("06" . $this->faker->regexify('[0-9]{8}'));
            $contacts->setPhone("03" . $this->faker->regexify('[0-9]{8}'));
            $contacts->setEmail($this->faker->email);
            $contacts->setEmailPrechecked($this->faker->boolean());
            $contacts->setEmailChecked($this->faker->boolean());
            $contacts->setLinkedin($this->faker->url);
            $contacts->setOperationSource($this->faker->word);
            $contacts->setComment($this->faker->text($maxNbChars = 50));
            $contacts->setOptInNewsletter($this->faker->boolean());
            $contacts->setOptInOffresCommercial($this->faker->boolean());

            $contacts->setCompany($this->getRandomReference("Company"));
            return $contacts;
        });
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProfessionFixtures::class,
            CompanyFixtures::class
        ];
    }
}
