<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

//test
use Symfony\Component\Form\Forms;


class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        
        $articles = $articleRepository->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/remove/{id}', name: 'remove' )]
    public function removeAction($id , EntityManagerInterface $entityManagerInterface, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);

        $entityManagerInterface -> remove( $article) ;
        $entityManagerInterface -> flush();

        return $this->redirectToRoute('app_article');

    }

    // #[Route('/add', name: 'addArticle' )]
    // public function AddArticle(ObjectManager $manager, EntityManagerInterface $entityManagerInterface, Article $article): Response
    // {
    //     $article = New Article;
        
    //     $form = $this->createFormBuilder($article)
    //         ->add('title', Article::class)
    //         ->add('Text', Article::class) 
    //         ->add('Autor', Article::class)
            //bouton submit 
        //    ->add('submit', Article::class, array('label' => 'Ajout d\'un article'))
       //     ->getForm();

            // $article->setTitle(setTitle($title));
            // $article->setText();
            // $article->setAutor();
        
        // $manager->persist($form);
        // $entityManagerInterface -> flush();

        // return $this->render('article/index.html.twig', [
        //     'form' => $form
        // ]);

    //}

}


