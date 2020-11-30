<?php

namespace App\DataFixtures;

use Faker\Factory; 
use App\Entity\MicroFilm;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MicroFilmFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("FR-fr");

        for ($i = 0; $i < 50; $i++) {
            $microFilm = new MicroFilm();

            $microFilm->setTitle($faker->sentence())
                ->setCote($faker->sentence())
                ->setPicture($faker->imageURL())
                ->setAvailability($faker->numberBetween(0, 1))
                ->setCreatedAt(new \DateTime());

            $manager->persist($microFilm);
        }
        $manager->flush();
    }
}
