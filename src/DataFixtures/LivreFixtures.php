<?php

namespace App\DataFixtures;

use Faker\Factory; 
use App\Entity\Livre;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("FR-fr");

        for ($i = 0; $i < 50; $i++) {
            $livre = new Livre();

            $livre->setTitle($faker->sentence())
                ->setCote($faker->sentence())
                ->setPicture($faker->imageURL())
                ->setAuthtor($faker->firstName())
                ->setSpecial($faker->numberBetween(0, 1))
                ->setAvailability($faker->numberBetween(0, 1));

            $manager->persist($livre);
        }
        $manager->flush();
    }
}
