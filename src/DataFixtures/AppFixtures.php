<?php

namespace App\DataFixtures;

use DateTime;
use App\AdminBundle\Entity\Salesperson;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

   public function load(ObjectManager $manager)
   {
       $users = [
           ["email" => "test@test.com", "password" => "test"],
           ["email" => "toto@test.com", "password" => "toto"],
           ["email" => "tata@test.com", "password" => "tata"],
           ["email" => "titi@test.com", "password" => "titi"],
       ];
        $i = 0;
       foreach ($users as $data) {
           $salesperson = new Salesperson();
           $datetime = new DateTime();

           $salesperson->setGender("Homme");
           $salesperson->setCode("AZERTYUIO" . $i);
            $i++;
           $salesperson->setFirstName('Baptiste');
           $salesperson->setLastName('ROSSIGNOL');
           $salesperson->setProfile('Commercial');
           $salesperson->setCreatedAt($datetime);
           $salesperson->setUpdatedAt($datetime);
           $salesperson->setEmail($data["email"]);
           $salesperson->setPassword($this->passwordEncoder->encodePassword(
               $salesperson,
               $data["password"]
           ));

           $salesperson->setRoles(["ROLE_ADMIN"]);
           $manager->persist($salesperson);
       }

       $manager->flush();
   }
}