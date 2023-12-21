<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RechercheFormType;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index_accueil')]
    public function index(): Response
    {
        $rechercheForm = $this->createForm(RechercheFormType::class);

        return $this->render('client/index.html.twig', [
            'rechercheForm' => $rechercheForm->createView(),
        ]);
    }
}
