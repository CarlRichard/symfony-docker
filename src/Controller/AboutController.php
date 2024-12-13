<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(): Response
    {

$teamMenbers = [
    [
    'name' => 'John Doe',
    'role' => 'Lead developer',
    'bio' => 'Dev expert spé symfony',
    ],
    [
    'name' => 'Jane Smith',
    'role' => 'Designer UI/UX',
    'bio' => 'creative',
    ],
    [
    'name' => 'Alice Brown',
    'role' => 'Project Manager',
    'bio' => 'organise l\'equipe sur le projet',
    ]
];

        return $this->render('about/about.html.twig', [
            'team_members' => $teamMenbers,
        ]);
    }
}
