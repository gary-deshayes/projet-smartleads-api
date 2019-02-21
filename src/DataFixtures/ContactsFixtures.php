<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Contacts;
use App\AdminBundle\Entity\Profession;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ContactsFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(5, "Contacts", function ($count) {
            $contacts = new Contacts();
            $contacts->setCode("AZERTYUP" . $count);
            $contacts->setIdProfession($this->getRandomReference("Profession"));
            $contacts->setGender($this->faker->randomElement($array = array ('Homme', 'Femme', 'Non précisé')));
            $contacts->setLastName($this->faker->name);
            $contacts->setFirstName($this->faker->name);
            $contacts->setCreatedAt(new \DateTime());
            $contacts->setUpdatedAt(new \DateTime());
            $contacts->setStatus($this->faker->boolean());
            $contacts->setDecisionLevel($this->faker->numberBetween($min = 1, $max = 5));
            $contacts->setBirthDate($this->faker->dateTime($max = 'now', $timezone = null));
            // $contacts->setMobilePhone(str_replace("+33" , "0", str_replace(" ", "", $this->faker->mobileNumber)));
            // $contacts->setPhone(str_replace("+33", "0", str_replace(" ", "", $this->faker->phoneNumber)));
            $contacts->setEmail($this->faker->email);
            $contacts->setEmailPrechecked($this->faker->boolean());
            $contacts->setEmailChecked($this->faker->boolean());
            $contacts->setLinkedin($this->faker->url);
            $contacts->setPicture($this->faker->imageUrl($width = 640, $height = 480));
            $contacts->setOperationSource($this->faker->word);
            $contacts->setComment($this->faker->text($maxNbChars = 50));
            $contacts->setOptInNewsletter($this->faker->boolean());
            $contacts->setOptInOffresCommercial($this->faker->boolean());
            return $contacts;

        });
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProfessionFixtures::class];
    }
}
