<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {

        $faker = Factory::create("FR-fr");


        for ($i = 0; $i < 30; $i++) {
            $user = new User();


            $user->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setAddress($faker->address)
                ->setCity($faker->city)
                ->setPostalCode($faker->numberBetween(10000,98000))
                ->setPassword($this->encoder->encodePassword($user, 'password'))
                ->setCreatedAt(new \DateTime())
                ->setFees($faker->numberBetween(0,1)); 
            if ($i == 0) {
                $user->setRoles(["ROLE_ADMIN"]);
                $user->setEmail("admin@guinot.fr");
            } else {
                $user->setRoles(["ROLE_USER"]);
                $user->setEmail("user$i@guinot.fr");
            }

            $manager->persist($user);
        }

        $manager->flush();
    }
}
