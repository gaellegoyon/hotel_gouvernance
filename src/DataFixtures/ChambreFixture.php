<?php

namespace App\DataFixtures;

use App\Entity\Chambre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\HotelRepository;

class ChambreFixture extends Fixture
{
    public function load(ObjectManager $manager, HotelRepository $hotelR): void
    {
        $hotels = $hotelR->findAll();
        for ($y = 0; $y < 10; $y++) {
            $chambre = new Chambre();
            
            // Get a random Hotel object from the array
            $randomHotel = $hotels[array_rand($hotels)];

            // Set the Hotel for the Chambre entity
            $chambre->setHotel($randomHotel);

            $chambre->setNumero($y);
            $chambre->setNbLit($y);
            $manager->persist($chambre);
        }

        $manager->flush();
    }
}
