<?php


namespace App\Controller;

use App\Entity\Article;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class category extends AbstractController
{
    /**
     * @Route("/category", name="category_list")
     */
    /**
     * @Route("/category", name="category_page")
     */
    public function categoryList(CategoryRepository $catergoryRepository)
    {

        $categories = $catergoryRepository->findAll();

        return $this->render("Category.html.twig", [

            'categories' => $categories
        ]);
    }
}
