<?php

namespace App\Controller;

use App\Repository\HeroRepository;
use App\Repository\MonstreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'game_index')]
    public function index(HeroRepository $heroRepository, MonstreRepository $monstreRepository): Response
    {
        // Récupérer tous les héros et monstres
        $heroes = $heroRepository->findAll();
        $monsters = $monstreRepository->findAll();

        // Rendre une vue Twig
        return $this->render('game/index.html.twig', [
            'heroes' => $heroes,
            'monsters' => $monsters,
        ]);
    }

    #[Route('/battle/{heroId}/{monsterId}', name: 'battle')]
    public function battle(int $heroId, int $monsterId, HeroRepository $heroRepo, MonstreRepository $monsterRepo): Response
    {
        $hero = $heroRepo->find($heroId);
        $monster = $monsterRepo->find($monsterId);
    
        if (!$hero || !$monster) {
            throw $this->createNotFoundException('Hero or Monster non trouvé');
        }

        if (!$hero->getImg()) {
            $hero->setImg('default_hero_sprite.png');  
        }
        if (!$monster->getImg()) {
            $monster->setImg('default_monster_sprite.png');  
        }

        return $this->render('game/battle.html.twig', [
            'hero' => $hero,
            'monster' => $monster,
        ]);
    }
}
