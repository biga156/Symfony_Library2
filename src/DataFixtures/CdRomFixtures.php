<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\CDRom;
use App\Entity\Livre;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CdRomFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("FR-fr");

        for ($i = 0; $i < 50; $i++) {
            $cd = new CDRom();

            $cd->setTitle($faker->sentence())
                ->setCote($faker->sentence())
                ->setPicture($faker->imageURL())
                ->setAuthtor($faker->firstName())
                ->setAvailability($faker->numberBetween(0, 1))
                ->setBail(15);

            $manager->persist($cd);
        }


        $manager->flush();
    }
}
