<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Loan;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LoanFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);


        for($i=0; $i>=30; $i++){
            $loan= new Loan();

            $loan->setCreatedAt(new \DateTime())
            ->setSearchable(mt_rand(0,1))
            ->setSatus();
        }
        $manager->flush();
    }
}
