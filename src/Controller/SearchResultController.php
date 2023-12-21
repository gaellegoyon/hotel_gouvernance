<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchResultController extends AbstractController
{
    #[Route('/search', name: 'app_search_result')]
    public function index(): Response
    {
        return $this->render('client/search.html.twig', [
        ]);
    }
}
