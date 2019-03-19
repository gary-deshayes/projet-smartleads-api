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
        $this->createMany(10, "Salesperson", function ($count) {

            $salesperson = new Salesperson();

            $salesperson->setGender($this->faker->randomElement($array = array('Homme', 'Femme', 'Non précisé')));

            $salesperson->setCode($this->faker->regexify('[A-Z]{10}'));

            $salesperson->setFirstName($this->faker->firstName('male'|'female'));

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

        

        $manager->flush();
    }

}
