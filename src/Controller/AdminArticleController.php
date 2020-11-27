<?php


namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class AdminArticleController extends AbstractController
{
    /**
     * @Route("admin/articles", name="admin_articles_list")
     */
    public function articleList(ArticleRepository $articleRepository)
    {
        //Je récupère tout mes articles grâce a la wildcard findALL qui me permet des SELECT en BDD
        $articles = $articleRepository->findAll();

        return $this->render("admin/article/articles.html.twig", [
            'articles' => $articles
        ]);

    }
    /**
     * @Route("admin/article/insert", name="admin_article_insert")
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

        //Et je fais ma condition, qui me permet d'envoyer mon formulaire à la condition que mon formulaire à bien était envoyé
        //alors mon formualire sera envoyé en bdd
        if ($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash(
                "success",
                "Bravo ! ton article a été ajouté !"
            );
             return $this->redirectToRoute("admin_articles_list");
        }

        //dans une variable je transforme mon form brut php a l'aide de mon creatView un formulaire lisible par mon html.twig
        $formView = $form->createView();

        //Pour finir je retourne ma reponse http en html par mon html.twig
        return $this->render('admin/article/insert.html.twig',[

            'formView' => $formView
        ]);
    }

    /**
     * @Route("admin/article/update/{id}", name="admin_article_update")
     */

    //Je créée ma nouvelle methode pour ajouter un nouvel article, comprenant ma WildCard 'id', ainsi que mes fonctions
    //instanciés pas Symfo et stockés dans des variables
    public function updateArticle(
        $id,
        ArticleRepository $articleRepository,
        request $request,
        EntityManagerInterface $entityManager
    ) {

        //Dans une variable, je comprend mon lien a ma bdd et fait appel a mes id de la bdd
        $article = $articleRepository->find($id);

        //Je fais une première boucle for, Si mon formulaire est égal a null alors je renvois a la ma page 'admin_article_list
        if (is_null($article)){

            return $this->redirectToRoute('admin_articles_list');

        }

        //j'instancie dans une variable l'appel à mon form déja créé en ligne de commande ainsi qu'a ma table article en bdd
        $form = $this->createForm(ArticleType::class, $article);

        //Je lie mon From à requête POST
        $form->handleRequest($request);

        //pour ensuite faire une seconde boucle for, si mon form est envoyé, alors je :
        if ($form->isSubmitted() && $form->isValid()){
            //fait un pré enregistrement en bdd dans ma table article (équivalent d'un commit)
            $entityManager->persist($article);
            //Puis je pousse dans ma bdd (équivalent du push)
            $entityManager->flush();

            //Et j'envoie un message de validation
            $this->addFlash(
                "success",
                " Super! ton article a été modifié !"
            );

            return $this->redirectToRoute('admin_articles_list');

        }

        //Je créée dans une variable mon formulaire (qui est pour le moment en php brut) en form lisible par mon html.twig
        $formView = $form->createView();

        //Pour finir, je retourne une réponse http sur mon navigateur en html, par le bié de mon fichier html.twig
        return $this->render('admin/article/update.html.twig',[
            'formView' => $formView
        ]);

    }

    /**
     * @Route("admin/article/delete/{id}", name="admin_article_delete")
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
                         Bien ouèj !!"
            );
        }

        //Enfin je retourne ma reponse vers mon navigateur frâce a ma route articles_list
        return $this->redirectToRoute("admin_articles_list");

    }


}