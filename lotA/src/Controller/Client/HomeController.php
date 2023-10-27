<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $bestProductByCategory = [];

        $categories = $categoryRepository->findAll();

        foreach ($categories as $category) {
            $bestProductByCategory[] = $productRepository->findOneBy(['category' => $category->getUuid()], ['nb_sales' => 'DESC']);
        }

        $bestSells = $productRepository->findBy([], ['nb_sales' => 'DESC'], 5);

        return $this->render('home/home.html.twig', [
            'categories' => $categories,
            'bestSells' => $bestSells,
            'bestProductByCategory' => $bestProductByCategory
        ]);
    }
}
