<?php

namespace App\DataFixtures;

use App\Entity\Chambre;
use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        for($i = 0; $i < 10; $i++) {
            $hotel = new Hotel();
            $hotel->setNom('nom '.$i);
            $hotel->setLieu('lieu'.$i);
            $hotel->setNbChambre($i);
            $manager->persist($hotel);
            $manager->flush();
            for ($y = 1; $y < 30; $y = $y+3) {
                $chambre = new Chambre();
                $reservation = new Reservation();
                $reservation
                ->setNomClient('test'. $y)
                ->setNombreClient($y)
                ->setEmailClient('test@gmail.com'. $y);
                $dateDebut = \DateTime::createFromFormat('d/m/Y', '10/10/20' . $i);
                $reservation->setDateDebut($dateDebut);
                $dateFin = \DateTime::createFromFormat('d/m/Y', '10/10/20' . $i+1);
                $reservation->setDateFin($dateFin)
                ->setTelClient('061234567'.$y);
                $manager->persist($reservation);
                $chambre->setHotel($hotel);
                $chambre->setNumero($y);
                $chambre->addReservation($reservation);
                $chambre->setNbLit($y);
                if ($y % 2 === 0) {
                    $chambre->setEtat(1);
                    $manager->persist($chambre);
                } else {
                    $chambre->setEtat(0);
                    $manager->persist($chambre);
                }
                $manager->persist($chambre);
                for ($u = 1; $u < 10; $u++) {
                    $service = new Service();
                    $service->setHotel($hotel);
                    $service->setLibelle('serv'.$u);
                    $service->setLieu('ici'.$u);
                    $service->setTarif($u+15);
                    $service->addReservation($reservation);
                    $manager->persist($service);
                }
                for ($z = 1; $z < 10; $z++) {
                    $user = new User();
                    $user->setHotel($hotel);
                    $user->setNom('nom'.$z);
                    $user->setEmail('nom'.$z. '.test@test.com');
                    $user->setPassword("$2y$10\$MBbQI39oxmclR8ReZnAmR.dDnP7AD955VBTNB4urnc3OUM.1XQQ.i");
                    $user->setTelephone('06589874'.$z);
                    if ($z % 2 === 0) {
                        $user->setRole("ROLE_ADMIN");
                        $manager->persist($user);
                    } else {
                        $user->setRole("ROLE_USER");
                        $manager->persist($user);
                    }
                }
            }
            $manager->flush();
        }
    }
}
