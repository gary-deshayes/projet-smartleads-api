<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\User;
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

       foreach ($users as $data) {
           $user = new User();
           $user->setCode('29727');
           $user->setEmail($data["email"]);
           $user->setPassword($this->passwordEncoder->encodePassword(
               $user,
               $data["password"]
           ));

           $user->setRoles(["ROLE_ADMIN"]);
           $manager->persist($user);
       }

       $manager->flush();
   }
}