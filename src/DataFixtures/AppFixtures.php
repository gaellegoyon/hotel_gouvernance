<?php

namespace App\DataFixtures;

use App\Entity\Chambre;
use App\Entity\Hotel;
use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $reservation = new Reservation();
        $reservation
        ->setNomClient("test")
        ->setEmailClient('test@gmail.com')
        ->setTelClient('0612345678');
        
        $manager->persist($reservation);
        $manager->flush();
        for($i = 0; $i < 10; $i++) {
            $hotel = new Hotel();
            $hotel->setNom('nom '.$i);
            $hotel->setLieu('lieu'.$i);
            $hotel->setNbChambre($i);
            $manager->persist($hotel);
            $manager->flush();
            for ($y = 1; $y < 30; $y = $y+3) {
                $chambre = new Chambre();
                // Set the Hotel for the Chambre entity
                $chambre->setHotel($hotel);
                $chambre->setNumero($y);
                $chambre->setReservation($reservation);
                $chambre->setNbLit($y);
                $manager->persist($chambre);
            }
            $manager->flush();
        }
    }
}
