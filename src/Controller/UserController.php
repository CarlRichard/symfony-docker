<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(UserRepository $userRepository ): Response
    {

        $users = $userRepository->findAll();
       // dump($users);

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('user/{id}/partner', name: 'app_user_show', methods: ['GET'])]
    public function show( User $user): Response
    {

        $partner = $user->getCouple();

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'partner' => $partner,
        ]);
    }


}
