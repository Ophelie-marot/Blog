<?php


namespace App\Controller;

use App\Entity\Article;
use App\Repository\CategoryRepository;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class pageController extends AbstractController
{
    /**
     * @Route("/articles", name="articles_list")
     */
    public function articleList(ArticleRepository $articleRepository)
    {
        //Je récupère tout mes articles grâce a la wildcard findALL qui me permet des SELECT en BDD
        $articles = $articleRepository->findAll();

        return $this->render("articles.html.twig", [
            'articles' => $articles
        ]);

    }

    //Je créée ma route/ mon lien
    /**
     * @Route("/article/show/{id}", name="article_show")
     */

    //Puis ma nouvelle fonction qui me permettra d'utiliser de selectionner mes articles grâce a leurs id.
    //j'utilise la fonction 'find' qui me permettra d'aller les chercher directement dans ma bdd
    //et render pour faire le lien avec mon fichier twig
    public function articleShow($id, ArticleRepository $articleRepository)
    {
        $article1 =$articleRepository->find($id);

        return $this->render("article.html.twig",[

        //Puis je ctéée ma viariable, pour l'utiliser dans  mon fichier twig
            'article1'=>$article1
        ]);
    }

    /**
     * @Route("/article/insert-static", name="article-insert-static")
     */

    //Je créée une nouvelle methode qui utlislise la fonction 'EntityManagerInterface'
    public function insertStaticArticle(EntityManagerInterface $entityManager)
    {
        //Puis j'instancie dans une variable qui contient ma table article, et qui feras donc le lien avec ma BDD
        $article = new article();

        //Puis je rajoute tout mes éléments qui seront envoyés dans ma BDD
        $article->setTitle("Paris");
        $article->setContent("Paris est la ville la plus peuplée et la capitale de la France.
    Elle se situe au cœur d'un vaste bassin sédimentaire aux sols fertiles et au climat tempéré, le bassin parisien,
    sur une boucle de la Seine, entre les confluents de celle-ci avec la Marne et l'Oise. Paris est également le chef-lieu
    de la région Île-de-France et le centre de la métropole du Grand Paris, créée en 2016. Elle est divisée 
    en arrondissements, comme les villes de Lyon et de Marseille, au nombre de vingt. Administrativement, la ville 
    constitue depuis le 1er janvier 2019 une collectivité à statut particulier nommée « Ville de Paris »
    (auparavant, elle était à la fois une commune et un département). L'État y dispose de prérogatives particulières 
    exercées par le préfet de police de Paris. La ville a connu de profondes transformations sous le Second Empire dans 
    les décennies 1850 et 1860 à travers d'importants travaux consistant notamment au percement de larges avenues,
    places et jardins et la construction de nombreux édifices, dirigés par le baron Haussmann, donnant à l'ancien Paris
    médiéval le visage qu'on lui connait aujourd'hui.");
        $article->setPicture("https://upload.wikimedia.org/wikipedia/commons/c/c6/Tour_eiffel_paris-eiffel_tower.jpg");
        $article->setDate(new \DateTime());
        $article->setPublish(true);

        //Je pré enregistre en faisant un 'persist', équivalant de 'commit' dans Git
        $entityManager->persist($article);

        //Puis un Flush qui est mon équivalant de 'push'
        $entityManager->flush();

        //Puis je retourne ma requête instancié par mon controller, ma reponse HTTP vers mon navigateur, par le biait
        //de mon fichier twig
        return $this->render('article/insert_static.html.twig');

    }

    /**
     * @Route("article/update-static/{id}", name="update_static")
     */
    public function updateStaticArticle(ArticleRepository $articleRepository, EntityManagerInterface $entityManager,$id)
    {
        $article = $articleRepository->find($id);

        $article->setTitle("Bordeaux ma ville");

        $entityManager->persist($article);
        $entityManager->flush();

        return $this->render('article/update_static.html.twig');
    }

}