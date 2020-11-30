<?php

namespace App\DataFixtures;

use Faker\Factory; 
use App\Entity\CDRom;
use App\Entity\Livre;
use App\Entity\MicroFilm;
use App\Entity\NewsPaper;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("FR-fr");

        //Création des livres 
        for ($i = 0; $i < 50; $i++) {
            $livre = new Livre();

            $livre->setTitle($faker->sentence())
                ->setCote($faker->sentence())
                ->setPicture($faker->imageURL())
                ->setAuthtor($faker->firstName())
                ->setSpecial($faker->numberBetween(0, 1))
                ->setAvailability($faker->numberBetween(0, 1))
                ->setSearchable(0);


            $manager->persist($livre);
        }

        //Création des microfilms 
        for ($i = 0; $i < 50; $i++) {
            $microFilm = new MicroFilm();

            $microFilm->setTitle($faker->sentence())
                ->setCote($faker->sentence())
                ->setPicture($faker->imageURL())
                ->setAvailability($faker->numberBetween(0, 1))
                ->setCreatedAt(new \DateTime())
                ->setSearchable(1);

            $manager->persist($microFilm);
        }  
        
        //Création des newsPaper
        for ($i = 0; $i < 50; $i++) {
            $newPapers = new NewsPaper();

            $newPapers->setTitle($faker->sentence())
                ->setCote($faker->sentence())
                ->setPicture($faker->imageURL())
                ->setAvailability($faker->numberBetween(0, 1))
                ->setCreatedAt(new \DateTime())
                ->setSearchable(1);


            $manager->persist($newPapers);
        }

        //Création des CDRom 
        for ($i = 0; $i < 50; $i++) {
            $cd = new CDRom();

            $cd->setTitle($faker->sentence())
                ->setCote($faker->sentence())
                ->setPicture($faker->imageURL())
                ->setAuthtor($faker->firstName())
                ->setAvailability($faker->numberBetween(0, 1))
                ->setBail(15)
                ->setSearchable(0);

            $manager->persist($cd);
        }

        //Création des users
        for ($i = 0; $i < 30; $i++) {
            $user = new \App\Entity\User();


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
