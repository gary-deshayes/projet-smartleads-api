<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Salesperson;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SalespersonFixtures extends BaseFixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(100, "Salesperson", function ($count) {

            $salesperson = new Salesperson();

            $salesperson->setGender($this->faker->randomElement($array = array('Homme', 'Femme', 'Non précisé')));

            $salesperson->setCode($this->faker->regexify('[A-Z]{10}'));

            $salesperson->setFirstName($this->faker->firstName('male' | 'female'));

            $salesperson->setLastName($this->faker->lastName);

            $salesperson->setProfile($this->faker->randomElement($array = array('Commercial', 'Directeur commercial', 'Responsable d\'équipe')));

            $salesperson->setCreatedAt(new \DateTime());

            $salesperson->setUpdatedAt(new \DateTime());

            $salesperson->setEmail($this->faker->email);

            $salesperson->setStatus($this->faker->boolean);

            $salesperson->setBirthDate($this->faker->dateTime($max = 'now', $timezone = null));

            $salesperson->setWorkName($this->faker->jobtitle);

            $salesperson->setMobilePhone("06" . $this->faker->randomNumber($nbDigits = 8, $strict = false));

            $salesperson->setPhone("03" . $this->faker->randomNumber($nbDigits = 8, $strict = false));

            $salesperson->setLinkedin($this->faker->url);

            $salesperson->setPassword($this->passwordEncoder->encodePassword($salesperson, "azerty"));

            $salesperson->setRoles($this->faker->randomElement($array = array(["ROLE_DIRECTEUR"], ["ROLE_COMMERCIAL"], ["ROLE_RESPONSABLE"])));

            return $salesperson;
        });
        // compte admin
        $directeur = new Salesperson();

        $directeur->setGender($this->faker->randomElement($array = array('Homme', 'Femme', 'Non précisé')));

        $directeur->setCode($this->faker->regexify('[A-Z]{10}'));

        $directeur->setFirstName($this->faker->firstName('male' | 'female'));

        $directeur->setLastName($this->faker->lastName);

        $directeur->setProfile($this->faker->randomElement($array = array('Directeur commercial')));

        $directeur->setCreatedAt(new \DateTime());

        $directeur->setUpdatedAt(new \DateTime());

        $directeur->setEmail("admin@smartleads.fr");

        $directeur->setStatus(true);

        $directeur->setBirthDate($this->faker->dateTime($max = 'now', $timezone = null));

        $directeur->setWorkName($this->faker->jobtitle);

        $directeur->setMobilePhone("06" . $this->faker->randomNumber($nbDigits = 8, $strict = false));

        $directeur->setPhone("03" . $this->faker->randomNumber($nbDigits = 8, $strict = false));

        $directeur->setLinkedin($this->faker->url);

        $directeur->setPassword($this->passwordEncoder->encodePassword($directeur, "azerty"));

        $directeur->setRoles(["ROLE_DIRECTEUR"]);

        // compte commercial
        $commercial = new Salesperson();

        $commercial->setGender($this->faker->randomElement($array = array('Homme', 'Femme', 'Non précisé')));

        $commercial->setCode($this->faker->regexify('[A-Z]{10}'));

        $commercial->setFirstName($this->faker->firstName('male' | 'female'));

        $commercial->setLastName($this->faker->lastName);

        $commercial->setProfile('Commercial');

        $commercial->setCreatedAt(new \DateTime());

        $commercial->setUpdatedAt(new \DateTime());

        $commercial->setEmail("commercial@smartleads.fr");

        $commercial->setStatus(true);

        $commercial->setBirthDate($this->faker->dateTime($max = 'now', $timezone = null));

        $commercial->setWorkName($this->faker->jobtitle);

        $commercial->setMobilePhone("06" . $this->faker->randomNumber($nbDigits = 8, $strict = false));

        $commercial->setPhone("03" . $this->faker->randomNumber($nbDigits = 8, $strict = false));

        $commercial->setLinkedin($this->faker->url);

        $commercial->setPassword($this->passwordEncoder->encodePassword($commercial, "azerty"));

        $commercial->setRoles(["ROLE_COMMERCIAL"]);

        // compte commercial
        $responsable = new Salesperson();

        $responsable->setGender($this->faker->randomElement($array = array('Homme', 'Femme', 'Non précisé')));

        $responsable->setCode($this->faker->regexify('[A-Z]{10}'));

        $responsable->setFirstName($this->faker->firstName('male' | 'female'));

        $responsable->setLastName($this->faker->lastName);

        $responsable->setProfile('Responsable');

        $responsable->setCreatedAt(new \DateTime());

        $responsable->setUpdatedAt(new \DateTime());

        $responsable->setEmail("responsable@smartleads.fr");

        $responsable->setStatus(true);

        $responsable->setBirthDate($this->faker->dateTime($max = 'now', $timezone = null));

        $responsable->setWorkName($this->faker->jobtitle);

        $responsable->setMobilePhone("06" . $this->faker->randomNumber($nbDigits = 8, $strict = false));

        $responsable->setPhone("03" . $this->faker->randomNumber($nbDigits = 8, $strict = false));

        $responsable->setLinkedin($this->faker->url);

        $responsable->setPassword($this->passwordEncoder->encodePassword($responsable, "azerty"));

        $responsable->setRoles(["ROLE_RESPONSABLE"]);

        $manager->persist($directeur);
        $manager->persist($commercial);
        $manager->persist($responsable);


        $manager->flush();
    }

}
