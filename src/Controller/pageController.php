<?php


namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ArticleRepository;
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

        return $this->render("articles.html.twig",[
            'articles'=>$articles
            ]);

    }
    /**
     * @Route("/category", name="category_page")
     */
    public function categoryList(CategoryRepository $catergoryRepository)
    {

        $categories = $catergoryRepository->findAll();

        return $this->render("Category.html.twig",[

            'categories'=>$categories
        ]);
    }


    //Je créée ma route/ mon lien
    /**
     * @Route("/article/{id}", name="article_show")
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


}