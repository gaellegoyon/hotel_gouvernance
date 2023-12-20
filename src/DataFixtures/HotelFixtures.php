<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HotelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        for($i = 0; $i < 10; $i++) {
            $hotel = new Hotel();
            $hotel->setNom('nom '.$i);
            $hotel->setLieu('lieu'.$i);
            $hotel->setNbChambre($i);
            $manager->persist($hotel);
        }
        $manager->flush();
    }
}
