<?php

namespace App\Controller;

use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RechercheFormType;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index_accueil')]
    public function index(HotelRepository $hotelRepository): Response
    {

        // Utiliser le repository pour récupérer les hôtels, par exemple :
        $hotels = $hotelRepository->findAll();

        $rechercheForm = $this->createForm(RechercheFormType::class);

        return $this->render('client/index.html.twig', [
            'rechercheForm' => $rechercheForm->createView(),
            'hotels' => $hotels, // Vous pouvez passer les hôtels à votre vue s'ils sont nécessaires
        ]);
    }
}
