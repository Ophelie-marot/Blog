<?php


namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class PageController extends AbstractController
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

    ///**
     //* @Route("/article/insert-static", name="article-insert-static")
     //*/

    //Je créée une nouvelle methode qui utlislise la fonction 'EntityManagerInterface'
    //public function insertStaticArticle(EntityManagerInterface $entityManager)
    //{
        //Puis j'instancie dans une variable qui contient ma table article, et qui feras donc le lien avec ma BDD
        //$article = new article();

        //Puis je rajoute tout mes éléments qui seront envoyés dans ma BDD
        //$article->setTitle("Paris");
        //$article->setContent("Paris est la ville la plus peuplée et la capitale de la France.
    //Elle se situe au cœur d'un vaste bassin sédimentaire aux sols fertiles et au climat tempéré, le bassin parisien,
    //sur une boucle de la Seine, entre les confluents de celle-ci avec la Marne et l'Oise. Paris est également le chef-lieu
    //de la région Île-de-France et le centre de la métropole du Grand Paris, créée en 2016. Elle est divisée
    //en arrondissements, comme les villes de Lyon et de Marseille, au nombre de vingt. Administrativement, la ville
    //constitue depuis le 1er janvier 2019 une collectivité à statut particulier nommée « Ville de Paris »
    //(auparavant, elle était à la fois une commune et un département). L'État y dispose de prérogatives particulières
    //exercées par le préfet de police de Paris. La ville a connu de profondes transformations sous le Second Empire dans
    //les décennies 1850 et 1860 à travers d'importants travaux consistant notamment au percement de larges avenues,
    //places et jardins et la construction de nombreux édifices, dirigés par le baron Haussmann, donnant à l'ancien Paris
    //médiéval le visage qu'on lui connait aujourd'hui.");
        //$article->setPicture("https://upload.wikimedia.org/wikipedia/commons/c/c6/Tour_eiffel_paris-eiffel_tower.jpg");
        //$article->setDate(new \DateTime());
        //$article->setPublish(true);

        //Je pré enregistre en faisant un 'persist', équivalant de 'commit' dans Git
        //$entityManager->persist($article);

        //Puis un Flush qui est mon équivalant de 'push'
        //$entityManager->flush();

        //Puis je retourne ma requête instancié par mon controller, ma reponse HTTP vers mon navigateur, par le biait
        //de mon fichier twig
        //return $this->render('article/insert_static.html.twig');

    //}

    //Je créée une nouvelle route, un nouveau lien pour modifier mes titres
    ///**
     //* @Route("article/update-static/{id}", name="update_static")
     //*/

    //Puis ma fonction avec mes focntions pour faire le lien avec ma bdd et ma wildcard 'id'
    //public function updateStaticArticle(ArticleRepository $articleRepository, EntityManagerInterface $entityManager,$id)
    //{
        //Je stocke dans une caribale ma fonction pour faire le lien avec ma bdd ainsi que la ma wilcard "$id"
        //$article = $articleRepository->find($id);

        //Je modifie mon titre
        //$article->setTitle("Ma ville");

        //je fais mon persite équilant de commit
        //$entityManager->persist($article);
        //et mon flush équivalant de push
        //$entityManager->flush();

        //Pour finir je fais appelle a ma fonction render pour retourner ma reponse en http par le bié de mon fichier twig
        //return $this->render('article/update_static.html.twig');
    //}
    /**
     * @Route("/article/insert", name="article_insert")
     */
    //Je créée ma méthode pour mon formulaire, fait a préalable avec ma ligne de commande
    public function insertArticle(Request $request, EntityManagerInterface $entityManager)
    {
        //Dans ma variable j'utilise le 'new Article' pour pouvoir modifier/manipuler ma table en bdd
        $article = new Article();

        // puis je stocke dans une variable l'appel a mon formulaire déja créée
        $form = $this->createForm(ArticleType::class, $article);

        //Je lie mon formulaire à ma requête POST
        $form->handleRequest($request);

        //Et je fais ma condition, qui me permet d'envoyer mon formulaire & la condition que tous mes champs soient valid
        if ($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($article);
            $entityManager->flush();
        }

        //dans une variable je transforme mon form brut php a l'aide de mon creatView un formulaire lisible par mon html.twig
        $formView = $form->createView();

        //Pour finir je retourne ma reponse http en html par mon html.twig
        return $this->render('article/insert.html.twig',[

            'formView' => $formView
            ]);
    }

    /**
     * @Route("/article/delete/{id}", name="article_delete")
     */
     //Je créée unne nouvelle methode pour supprimer un article avec ma wildCard, et j'instencie dans une viariable mes fonctions
    public function deleteArticle($id,ArticleRepository $articleRepository, EntityManagerInterface $entityManager)
    {
        //je stocke dans une variable mon appel a mes "id" dans ma bdd
        $article = $articleRepository->find($id);

        //Puis je fais une boucle for pour demander à ne supprimer mon article iniquement dans le cas où il n'est pas égale a null
        if(!is_null($article)){
            $entityManager->remove($article);
            $entityManager->flush();

        //et je fais appelle a ma fonction symfony add flash un pop up de succes
            $this->addFlash(
                "success",
                "Ton article à bien été supprimé
                        //Bien ouèj !!"
            );
        }

        //Enfin je retourne ma reponse vers mon navigateur frâce a ma route articles_list
        return $this->redirectToRoute("articles_list");

    }


}