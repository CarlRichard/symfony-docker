<?php

namespace App\Controller;

use App\Repository\MaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MaisonController extends AbstractController
{
    #[Route('/maison', name: 'app_maison')]
    public function index(MaisonRepository $maisonRepository): Response
    {

        $maisons = $maisonRepository->findAll();
        

        return $this->render('maison/index.html.twig', [
            'maisons' => $maisons,
        ]);
    }
}
