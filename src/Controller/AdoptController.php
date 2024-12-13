<?php

namespace App\Controller;

use App\Repository\AdoptionRepository;
use App\Repository\AdoptRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdoptController extends AbstractController
{
    #[Route('/adopt', name: 'app_adopt')]
    public function index(AdoptRepository $adoption): Response
    {

        $adopts = $adoption->findAll();

        return $this->render('adopt/index.html.twig', [
            'adoptions' => $adopts,
        ]);
    }
}
