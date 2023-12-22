<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\RechercheFormType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchResultController extends AbstractController
{
    #[Route('/search', name: 'app_search_result', methods: ['GET', 'POST'])]
    public function index(Request $request, ChambreRepository $chambreRepository): Response
    {

        $form = $this->createForm(RechercheFormType::class);
        $resultats=[];

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $form->getData();

            $lieu = $data['lieu'];
            $libelle = $data['libelle'];
            $dateArrivee = $data['dateArrivee'];
            $dateDepart = $data['dateDepart'];
            

            $resultats = $chambreRepository->rechercherChambres($lieu, $libelle, $dateArrivee, $dateDepart);

        }

        return $this->render('client/search.html.twig', [
            'form' => $form->createView(),
            'resultats' => $resultats
        ]);
    }

    #[Route('/create-reservation', name: 'app_create_reservation', methods: ['GET', 'POST'])]
    public function createReservation(Request $request, EntityManagerInterface $entityManager)
    {
        $chambreId = $request->get('chambreId');
        $nom_client = $request->get('nom_client');
        $tel_client = $request->get('tel_client');
        $email_client = $request->get('email_client');
      
        dd($request, $_POST, $_GET, $chambreId, $nom_client, $tel_client, $email_client);

        $reservation = new Reservation();
    
        $reservation->setChambre($chambreId);
        $reservation->setNomClient($nom_client);
        $reservation->setTelClient($tel_client);
        $reservation->setEmailClient($email_client);
    
        $entityManager->persist($reservation);
    

        $entityManager->flush();
    
        return new Response('Réservation créée avec succès!');
    }
}
