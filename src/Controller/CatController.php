<?php

namespace App\Controller;

use App\Entity\Cat;
use App\Form\CatType;
use App\Form\DeleteCategoryFormType;
use App\Form\SearchCatFormType;
use App\Repository\CatRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatController extends AbstractController
{
    #[Route('/cat', name: 'app_cat')]
    public function index(CatRepository $catsRepository, UserRepository $userRepository): Response
    {

        $cats = $catsRepository->findAll();


        return $this->render('cat/index.html.twig', [
            'cats' => $cats,
        ]);
    }

    #[Route('/new', name: 'cat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cat = new Cat();
        $form = $this->createForm(CatType::class, $cat);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
             $file = $form->get('img')->getData();

            if ($file) {
                $filename = uniqid() . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('cats_directory'), 
                    $filename
                );
                $cat->setImg($filename);
            }

            $entityManager->persist($cat);
            $entityManager->flush();

            return $this->redirectToRoute('app_cat', [], Response::HTTP_SEE_OTHER);
        }

    return $this->render('cat/new.html.twig', [
        'form' => $form->createView(), 
    ]);
    }

    #[Route('/search-user-by-chat', name: 'search_user_by_chat', methods: ['GET', 'POST'])]
    public function searchUserByChat(Request $request, CatRepository $catRepository): Response
    {
        $form = $this->createForm(SearchCatFormType::class);
        $form->handleRequest($request);
        $maitreName = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $chatName = $form->get('cat_name')->getData();
            $cat = $catRepository->findOneBy(['name' => $chatName]);
    
            if ($cat) {
                $maitre = $cat->getAdoption()->first(); 
                //si maitre est non nul , on affiche nom + ' '+ prenom sinon aucun
                $maitreName = $maitre ? $maitre->getName() .' '.$maitre->getLastName() : 'Aucun propriétaire trouvé';
            } else {
                $maitreName = 'Chat non trouvé';
            }
        }
    
        return $this->render('cat/search-user-by-chat.html.twig', [
            'form' => $form->createView(),
            'maitreName' => $maitreName,
        ]);
    }

    #[Route('/user/{id}/remove-chat/{chatId}', name: 'delete_adoption', methods: ['POST'])]
    public function delete(
        Request $request, 
        UserRepository $userRepository, 
        CatRepository $catRepository, 
        EntityManagerInterface $entityManager,
        int $id, 
        int $chatId
    ): Response {
        $user = $userRepository->find($id);
        $cat = $catRepository->find($chatId);
    
        $message = null;
    
        if ($user && $cat) {
            // Récupération de l'adoption
            $adopt = $user->getAdopts()->filter(function($adopt) use ($cat) {
                return $adopt->getCat() === $cat;
            })->first();
    
            if ($adopt) {
                $user->removeAdopt($adopt);
                $entityManager->flush();
                $message = 'Le chat a été abandonné par son maître.';
            } else {
                $message = 'Ce chat n\'a pas été adopté .';
            }
        } else {
            $message = 'Chat non trouvé';
        }
    
        return $this->redirectToRoute('app_user', ['message' => $message]);
    }
    
    
}
