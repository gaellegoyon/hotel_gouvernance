<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\RechercheFormType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    $data = json_decode($request->getContent(), true);

    $chambreId = $data['chambreId'] ?? null;
    $nom_client = $data['nom_client'] ?? null;
    $tel_client = $data['tel_client'] ?? null;
    $email_client = $data['email_client'] ?? null;


        $reservation = new Reservation();

        $reservation->setChambre($chambreId);
        
        // Assurez-vous que $nom_client est une chaîne avant de le définir
        $nom_client = is_string($nom_client) ? $nom_client : '';
        $tel_client = is_string($tel_client) ? $tel_client : '';
        $email_client = is_string($email_client) ? $email_client : '';


        $reservation->setNomClient($nom_client);
        $reservation->setTelClient($tel_client);
        $reservation->setEmailClient($email_client);

        $entityManager->persist($reservation);
        $entityManager->flush();

    
}

}
