<?php

namespace App\DataFixtures;

use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Article;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        for ( $i = 1; $i <= 5 ; $i++ ){

            $article = new Article();
            $article->setTitle( $faker->sentence(3) );
            $article->setText( $faker->paragraph(5) );
            $article->setAutor( $faker->name() );

            $manager->persist($article); // prepare la requete sous forme de tableau
        }

        $manager->flush(); // push l'ajout dans la DB
    }
};
 