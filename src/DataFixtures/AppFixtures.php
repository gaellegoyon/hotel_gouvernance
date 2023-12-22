<?php

namespace App\DataFixtures;

use App\Entity\Chambre;
use App\Entity\Categorie;
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

         $categoriesData = [
            ['libelle' => 'Standard', 'tarif' => 42, 'equipement' => ['TV', 'petit-déjeuner']],
            ['libelle' => 'Suite', 'tarif' => 57, 'equipement' => ['TV', 'petit-déjeuner']],
            ['libelle' => 'Villa', 'tarif' => 72, 'equipement' => ['TV', 'petit-déjeuner']],
            ['libelle' => 'Premium', 'tarif' => 88, 'equipement' => ['TV', 'petit-déjeuner']],
        ];

        foreach ($categoriesData as $data) {
            $categorie = new Categorie();
            $categorie->setLibelle($data['libelle']);
            $categorie->setTarif($data['tarif']);
            $categorie->setEquipement($data['equipement']);

            $manager->persist($categorie);
        }
        
       
            $manager->flush();
        }
        
    
}
