<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i=1; $i<=10; $i++)
        {
            $article=new Article();//ici on instancie, un nouvel objet hérite de l'entité articleApp\entity\Article à chaque tour de boucle, pour autant d'article intencier il y aura un insert supplémentaire en BDD
            $article->setNom("Article N° ". $i)
                ->setPrix(rand(100, 400))
                ->setDateCrea(new \DateTime())
                ->setRef("ref ". $i )
                ->setPhoto("https://picsum.photos/600/". $i);
            //ici on "habille nos objets Nu instanciés précédement" avec les setter de nos différentes propriétés héritées de notre objet Article entity

            $manager->persist($article); //persist est une méthode issue de la classe ObjectManager qui permet de garder en mémoire les objets articles créé précédements et de préparer et binder les requetes (les valeursà inserer) avant insertion

        }

        $manager->flush();
        //flush est une méthode de ObectManager qui permet d'éxécuter les requetes prépareés lors du persist() et permet ainsi les insert en BDD

        //une fois réalisé, il faut charger les fixtures en BDD grace à DOCTRINE avec la commande suivante: php bin/console doctrine:fixtures:load
    }
}
